<?php

use Kirby\Filesystem\File;
use TillProchaska\KirbyConsole\Application;

beforeEach(function () {
    $this->application = (new Application())->withKirbyInstance($this->kirby);
});

it('loads commands defined in `site/commands`', function () {
    expect($this->application->all())->not()->toHaveKey('hello-world');
    expect(class_exists('HelloWorldCommand'))->toBeFalse();

    $this->application->loadCommands();

    expect($this->application->all())->toHaveKey('hello-world');
    expect(class_exists('HelloWorldCommand'))->toBeTrue();
});

it('derives class name from file name', function () {
    $this->application->loadCommands();
    $command = $this->application->get('hello-world');
    expect($command)->toBeInstanceOf(HelloWorldCommand::class);
});

it('raises exception if class name does not match file name', function () {
    $commandFile = new File(kirby()->root('site').'/commands/hello-world.php');
    $commandFile = $commandFile->rename('lorem-ipsum');

    $newCommandSource = str_replace(
        'class HelloWorldCommand',
        'class LoremIspumCommand', // class name contains a typo
        $commandFile->read(),
    );

    $commandFile->write($newCommandSource);
    $this->application->loadCommands();
})->throws(
    \Exception::class,
    'Failed to load class `LoremIpsumCommand` in `lorem-ipsum.php`.',
);
