<?php

declare(strict_types=1);

namespace App\Console;

use App\UserTextMapper;
use App\UserTextStorageManager;

class ReplaceDates extends Command
{
    protected static string $name = 'ReplaceDates';

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = new UserTextStorageManager(PROJECT_ROOT . 'texts');
        $texts = new UserTextMapper($storage);

        $texts = $texts->findAll();
        $file = new \SplFileObject($texts[0]->path, 'r');
        $text = file_get_contents($texts[0]->path);

        $str = preg_replace_callback('/p/', function ($char) {
            $char = $char[0];
            return $char . $char . $char;
        }, $text);
    }
}