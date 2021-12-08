<?php

namespace TillProchaska\KirbyConsole;

use Kirby\Cms\App as Kirby;
use Kirby\Filesystem\Dir;
use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    protected Kirby $kirby;

    public function withKirbyInstance(Kirby $kirby): self
    {
        $this->kirby = $kirby;

        return $this;
    }

    public function loadCommands(): self
    {
        $kirby = $this->kirby ?? kirby();
        $dir = $kirby->root('site').'/commands';

        foreach (Dir::files($dir, absolute: true) as $path) {
            if (!str_ends_with($path, '.php')) {
                continue;
            }

            require_once $path;

            $file = basename($path, '.php');

            // convert file name to camel-cased class name
            $class = $file.'Command';
            $class = explode('-', $class);
            $class = implode('', array_map(fn ($part) => ucfirst($part), $class));

            if (!class_exists($class)) {
                throw new \Exception("Failed to load class `{$class}` in `{$file}.php`.");
            }

            $this->add(new $class());
        }

        return $this;
    }
}
