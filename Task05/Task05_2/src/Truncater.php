<?php

namespace App\src;

class Truncater
{
    private string $separator;

    public function __construct(string $separator = '...')
    {
        $this->separator = $separator;
    }

    public function configure(array $options): void
    {
        if (array_key_exists('separator', $options)) {
            $this->separator = $options['separator'];
        }
    }

    public function truncate(string $text, int $limit): string
    {
        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        return mb_substr($text, 0, $limit) . $this->separator;
    }
}
