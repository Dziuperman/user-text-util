<?php

declare(strict_types=1);

namespace App\Console;

interface InputInterface
{
    public function getArguments(): array;

    public function getLastArgument(): string;
}