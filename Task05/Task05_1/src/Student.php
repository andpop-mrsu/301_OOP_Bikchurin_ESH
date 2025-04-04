<?php

namespace App\src;

class Student
{
    private static int $counter = 1;

    private int $id;
    private string $lastName;
    private string $firstName;
    private string $faculty;
    private int $course;
    private string $group;

    public function __construct(
        string $lastName,
        string $firstName,
        string $faculty,
        int $course,
        string $group
    ) {
        $this->id = self::$counter++;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->faculty = $faculty;
        $this->course = $course;
        $this->group = $group;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getFaculty(): string
    {
        return $this->faculty;
    }

    public function getCourse(): int
    {
        return $this->course;
    }

    public function getGroup(): string
    {
        return $this->group;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function setFaculty(string $faculty): self
    {
        $this->faculty = $faculty;
        return $this;
    }

    public function setCourse(int $course): self
    {
        $this->course = $course;
        return $this;
    }

    public function setGroup(string $group): self
    {
        $this->group = $group;
        return $this;
    }

    public function __toString(): string
    {
        return sprintf(
            "Id: %d\nФамилия: %s\nИмя: %s\nФакультет: %s\nГруппа: %s\n",
            $this->id,
            $this->lastName,
            $this->firstName,
            $this->faculty,
            $this->group
        );
    }
}
