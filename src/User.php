<?php

declare(strict_types=1);

namespace App;

final class User
{
    /**
     * @var list<UserText>
     */
    private array $texts = [];

    public function __construct(
        public readonly string $id,
        public readonly string $name,
        array $texts = []
    )
    {
        foreach ($texts as $text) {
            $this->addText($text);
        }
    }

    /**
     * @param list<UserText> $texts
     */
    public function addTexts(array $texts): void
    {
        foreach ($texts as $text) {
            $this->addText($text);
        }
    }

    public function addText(UserText $text): void
    {
        $this->texts[] = $text;
    }

    public function averageLineCount(): float
    {
        $counts = array_map(fn ($text) => $text->rowsCount, $this->texts);
        return self::average($counts);
    }

    /**
     * @return list<UserText>
     */
    public function getTexts(): array
    {
        return $this->texts;
    }

    private static function average(array $array, bool $includeEmpties = true): float
    {
        $array = array_filter($array, fn($v) => (
            $includeEmpties ? is_numeric($v) : is_numeric($v) && ($v > 0)
        ));

        return array_sum($array) / (count($array) ?: 1);
    }
}
