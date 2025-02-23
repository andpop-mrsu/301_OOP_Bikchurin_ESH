<?php

namespace App\students;

class StudentsList
{
    protected array $students = [];

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    public function count(): int
    {
        return count($this->students);
    }

    public function get(int $n): Student
    {
        return $this->students[$n];
    }

    public function store(string $filename): void
    {
        file_put_contents($filename, serialize($this->students));
    }

    public function load(string $fileName): void
    {
        if (file_exists($fileName)) {
            $this->students = unserialize(file_get_contents($fileName), ['allowed_classes' => ['Student']]) ?: [];
        }
    }
}
