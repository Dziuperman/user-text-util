<?php

declare(strict_types=1);

namespace App;

final class UserMapper
{
    public function __construct(private StorageManager $storage)
    {
    }

    /**
     * @return list<User>
     */
    public function findAll(): array
    {
        return array_map(
            fn ($user) => $this->mapRowToUser($user),
            $this->storage->findAll()
        );
    }

    private function mapRowToUser(array $row): User
    {
        return new User(
            id: $row['id'],
            name: $row['name'],
        );
    }
}