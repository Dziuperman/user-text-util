<?php

declare(strict_types=1);

namespace App;

final class UserText
{
    public function __construct(
        public readonly int $id,
        public readonly int $userId,
        public readonly string $path,
        public readonly int $rowsCount,
    )
    {
    }
}