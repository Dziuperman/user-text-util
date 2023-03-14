<?php

declare(strict_types=1);

namespace App\Console;

use LogicException;

class Command
{
    public const SUCCESS = 0;
    public const FAILURE = 1;
    public const INVALID = 2;

    protected static string $name;

    public function execute(InputInterface $input, OutputInterface $output)
    {
        throw new LogicException('You must override the execute() method in the concrete command class.');
    }

    public static function getName(): string
    {
        return static::$name;
    }
}