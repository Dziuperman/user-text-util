<?php

declare(strict_types=1);

namespace App\Console;

interface OutputInterface
{
    public function write(string $message, bool $newLine);

    public function writeln(string $message);
}