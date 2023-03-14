<?php

declare(strict_types=1);

namespace App;

final class StorageManager
{
    private string $path;

    public function __construct($separator = ';')
    {
        $this->path = PROJECT_ROOT . '/people.csv';
    }

    public function findAll(): array
    {
        $users = [];

        if (($handle = fopen($this->path, 'r')) !== false) {
            while (($user = fgetcsv(stream: $handle, separator: ';')) !== false) {
                $users[$user[0]] = [
                    'id' => $user[0],
                    'name' => $user[1]
                ];
            }

            fclose($handle);
        }

        $usersTexts = [];
        $textsDirectory = new \FilesystemIterator(PROJECT_ROOT . '/texts');

        foreach($textsDirectory as $file) {
            $fileObject = $file->openFile();
            $fileObject->seek(PHP_INT_MAX);
            $count = $fileObject->key() + 1;
        }

        foreach($users as $id => $user) {
            $users[$id]['averageLineCount'] = static::average(($usersTexts[$id] ?? []));
        }

        return array_values($users);
    }

    private static function average(array $array, bool $includeEmpties = true): float
    {
        $array = array_filter($array, fn($v) => (
        $includeEmpties ? is_numeric($v) : is_numeric($v) && ($v > 0)
        ));

        return array_sum($array) / (count($array) ?: 1);
    }
}