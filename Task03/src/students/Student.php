<?php

namespace App\students;

class Student
{
    protected static int $idCounter = 1;
    protected int $id;
    protected string $secondName;
    protected string $firstName;
    protected string $faculty;
    protected int $course;
    protected string $group;

    public function __construct($secondName, $firstName, $faculty, $course, $group)
    {
        $this->id = self::$idCounter++;
        $this->secondName = $secondName;
        $this->firstName = $firstName;
        $this->faculty = $faculty;
        $this->course = $course;
        $this->group = $group;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSecondName(): string
    {
        return $this->secondName;
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

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function setSecondName(string $secondName): self
    {
        $this->secondName = $secondName;
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
        return $this->id . ' ' . $this->secondName . ' ' . $this->firstName . ' ' . $this->faculty . ' ' . $this->course . ' ' . $this->group;
    }
}
