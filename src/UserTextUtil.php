<?php

declare(strict_types=1);

namespace App;

use App\Console\ConsoleInput;
use App\Console\CountAverageLineCount;
use App\Console\ReplaceDates;
use App\Console\StreamOutput;
use App\Console\Command;

final class UserTextUtil
{
    /**
     * @var array<int, class-string>
     */
    private array $commands = [
        CountAverageLineCount::class,
        ReplaceDates::class,
    ];

    private ConsoleInput $input;

    /**
     * @var array<string, class-string>
     */
    private array $registeredCommands;

    public function __construct(ConsoleInput $input)
    {
        $this->input = $input;
        $this->registerCommands();
    }

    public function run(): void
    {
        $commandName = $this->input->getLastArgument();

        $commandClass = $this->registeredCommands[$commandName];

        /** @var Command $command */
        $command = new $commandClass();

        $command->execute(new ConsoleInput(), new StreamOutput(STDOUT));
    }

    private function registerCommands(): void
    {
        foreach ($this->commands as $command) {
            $this->registeredCommands[$command::getName()] = $command;
        }
    }
}