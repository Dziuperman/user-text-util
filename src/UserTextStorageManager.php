<?php

declare(strict_types=1);

namespace App;

final class UserTextStorageManager
{
    private readonly \FilesystemIterator $store;

    public function __construct(string $path)
    {
        $this->store = new \FilesystemIterator($path);
        $this->store->setFlags(\FilesystemIterator::SKIP_DOTS);
    }

    public function findAll(): array
    {
        $result = [];

        foreach ($this->store as $file) {
            $result[] = $this->getTextByFile($file);
        }

        return $result;
    }

    private function getTextByFile(\SplFileInfo $file): ?array
    {
        if ($file->getExtension() !== 'txt') return null;

        [$userId, $zeroFilledId] = explode('-', $file->getFilename());
        $userId = (int) $userId;
        $id = (int) $zeroFilledId;

        $count = $this->calculateLinesCount($file->getRealPath());

        return [
            'id' => $id,
            'userId' => $userId,
            'path' => $file->getRealPath(),
            'rowsCount' => $count
        ];
    }

    private function calculateLinesCount(string $file): int
    {
        $file = new \SplFileObject($file, 'r');
        $file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::DROP_NEW_LINE);

        return iterator_count($file);
    }
}