<?php

declare(strict_types=1);

use App\Console\ConsoleInput;
use App\UserTextUtil;

class Application
{
    public const COMMA = 'comma';

    public const SEMICOLON = 'semicolon';

    public function run(): void
    {
        [$separator, $commandName] = $this->getArguments();

        $userTextUtil = new UserTextUtil(new ConsoleInput());
        $userTextUtil->run();
    }

    public function getArguments()
    {
        return array_slice($_SERVER['argv'], 1);
    }
}
