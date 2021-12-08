<?php

namespace TillProchaska\KirbyConsole;

use Kirby\Cms\App;
use Kirby\Cms\Site;
use Symfony\Component\Console\Command\Command as BaseCommand;

class Command extends BaseCommand
{
    public function getName(): string
    {
        // Remove `Command` suffix
        $name = preg_replace('/Command$/', '', static::class);

        // Convert camel-cased name to lower-cased dash-separated name
        $name = preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $name);

        return strtolower($name);
    }

    protected function kirby(): App
    {
        return kirby();
    }

    protected function site(): Site
    {
        return $this->kirby()->site();
    }
}
