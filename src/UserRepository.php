<?php

declare(strict_types=1);

namespace App;

final class UserRepository
{
    public function __construct(
        private readonly UserMapper $userMapper,
        private readonly UserTextMapper $userTextMapper
    )
    {
    }

    /**
     * @return list<User>
     */
    public function getAllWithTexts(): array
    {
        $users = $this->userMapper->findAll();
        $texts = $this->userTextMapper->findAll();

        $groupedTexts = array_reduce(
            $texts,
            function ($carry, UserText $text) {
                $carry[$text->userId][] = $text;
                return $carry;
            },
            []
        );

        foreach ($users as $user) {
            $userTexts = $groupedTexts[$user->id] ?? [];

            $user->addTexts($userTexts);

        }

        return $users;
    }
}