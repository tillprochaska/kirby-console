#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use Kirby\Cms\App as Kirby;
use TillProchaska\KirbyConsole\Application;

// If you use a custom directory setup, configure Kirby accordingly:
//
// $kirby = new Kirby([
//     'roots' => [ ... ],
// ]);

$kirby = new Kirby();

(new Application)
    ->withKirbyInstance($kirby)
    ->loadCommands()
    ->run();
