<?php

declare(strict_types=1);

namespace App;

final class UserTextMapper
{
    public function __construct(private readonly UserTextStorageManager $storage)
    {
    }

    /**
     * @return list<UserText>
     */
    public function findAll(): array
    {
        return array_map(
            fn ($row) => $this->mapRowToUserText($row),
            $this->storage->findAll()
        );
    }

    private function mapRowToUserText(array $row): UserText
    {
        return new UserText(
            id: $row['id'],
            userId: $row['userId'],
            path: $row['path'],
            rowsCount: $row['rowsCount']
        );
    }
}