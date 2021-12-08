<?php

use TillProchaska\KirbyConsole\Command;
use TillProchaska\KirbyConsole\Input;
use TillProchaska\KirbyConsole\Output;

class HelloWorldCommand extends Command
{
    public function execute(Input $input, Output $output): int
    {
        echo 'Hello World!';

        return Command::SUCCESS;
    }
}
