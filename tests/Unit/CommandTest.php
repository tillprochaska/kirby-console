<?php

beforeEach(function () {
    $this->command = new HelloWorldCommand();
});

it('generates command name from class name', function () {
    expect($this->command->getName())->toBe('hello-world');
});
