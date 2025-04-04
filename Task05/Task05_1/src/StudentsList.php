<?php

namespace App\src;

use Iterator;

class StudentList implements Iterator
{
    /**
     * @var Student[]
     */
    private array $students = [];

    private int $position = 0;

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    public function get(int $index): ?Student
    {
        return $this->students[$index] ?? null;
    }

    public function count(): int
    {
        return count($this->students);
    }

    public function store(string $path): void
    {
        file_put_contents($path, serialize($this->students));
    }

    public function load(string $path): void
    {
        $content = file_get_contents($path);
        $this->students = unserialize($content, ['allowed_classes' => [Student::class]]);
    }

    public function current(): mixed
    {
        return $this->students[$this->position] ?? null;
    }

    public function key(): mixed
    {
        return $this->students[$this->position]?->getId();
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->students[$this->position]);
    }
}
