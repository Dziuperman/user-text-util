<?php

declare(strict_types=1);

namespace App\Console;

class ConsoleInput implements InputInterface
{
    public function getArguments(): array
    {
        return array_slice($_SERVER['argv'], 1);
    }

    public function getLastArgument(): string
    {
        return $this->getArguments()[array_key_last($this->getArguments())];
    }
}