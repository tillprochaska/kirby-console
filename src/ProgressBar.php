<?php

namespace TillProchaska\KirbyConsole;

use Symfony\Component\Console\Helper\ProgressBar as SymfonyProgressBar;

class_alias(SymfonyProgressBar::class, ProgressBar::class);
