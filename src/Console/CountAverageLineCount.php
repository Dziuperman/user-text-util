<?php

declare(strict_types=1);

namespace App\Console;

use App\StorageManager;
use App\UserMapper;
use App\UserRepository;
use App\UserTextMapper;
use App\UserTextStorageManager;

class CountAverageLineCount extends Command
{
    protected static string $name = 'countAverageLineCount';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = new StorageManager();
        $textStorage = new UserTextStorageManager(PROJECT_ROOT . 'texts');

        $userMapper = new UserMapper($storage);
        $userTextMapper = new UserTextMapper($textStorage);

        $users = (new UserRepository($userMapper, $userTextMapper))->getAllWithTexts();

        $response = '';
        foreach ($users as $user) {
            $response .= $user->name . ' : ' . $user->averageLineCount() . PHP_EOL;
        }

        $output->write($response);
    }
}