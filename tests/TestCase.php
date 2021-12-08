<?php

namespace TillProchaska\KirbyConsole\Tests;

use Kirby\Cms\App;
use Kirby\Filesystem\Dir;
use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * @internal
 * @coversNothing
 */
class TestCase extends BaseTestCase
{
    public const KIRBY_DIR = __DIR__.'/support/kirby';

    protected App $kirby;

    protected function setUp(): void
    {
        if (Dir::exists(static::KIRBY_DIR)) {
            Dir::remove(static::KIRBY_DIR);
        }

        Dir::make(static::KIRBY_DIR);

        $this->kirby = new App([
            'roots' => [
                'site' => __DIR__.'/support/kirby',
            ],
        ]);

        $this->setUpTestCommands();
    }

    protected function setUpTestCommands(): void
    {
        Dir::copy(__DIR__.'/support/commands', static::KIRBY_DIR.'/commands');
    }
}
