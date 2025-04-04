<?php

namespace App\Tests;

use App\src\Student;
use App\src\StudentList;
use PHPUnit\Framework\TestCase;

class StudentListTest extends TestCase
{
    private function buildSampleList(): StudentList
    {
        $list = new StudentList();
        $list->add(new Student('Elmir', 'Bikchurin', 'Math', 3, '301'));
        $list->add(new Student('Ivanov', 'Ivan', 'Physics', 3, '302'));
        $list->add(new Student('Kuznetsov', 'Artem', 'Biology', 1, '101'));
        return $list;
    }

    public function testCurrentReturnsCorrectStudent(): void
    {
        $students = $this->buildSampleList();
        $this->assertEquals($students->get(0), $students->current());
        $students->next();
        $this->assertEquals($students->get(1), $students->current());
    }

    public function testKeyReturnsStudentId(): void
    {
        $students = $this->buildSampleList();
        $this->assertSame($students->get(0)->getId(), $students->key());
    }

    public function testNextAdvancesPosition(): void
    {
        $students = $this->buildSampleList();
        $students->next();
        $this->assertSame($students->get(1), $students->current());
    }

    public function testRewindResetsPointer(): void
    {
        $students = $this->buildSampleList();
        $students->next();
        $students->next();
        $students->rewind();
        $this->assertSame($students->get(0), $students->current());
    }

    public function testValidDetectsEnd(): void
    {
        $students = $this->buildSampleList();
        $this->assertTrue($students->valid());
        $students->next();
        $students->next();
        $students->next();
        $this->assertFalse($students->valid());
    }

    public function testForeachIterationWorks(): void
    {
        $students = $this->buildSampleList();
        $index = 0;

        foreach ($students as $key => $student) {
            $this->assertSame($students->get($index), $student);
            $this->assertEquals($student->getId(), $key);
            $index++;
        }
    }

    public function testGetReturnsNullOnInvalidIndex(): void
    {
        $students = $this->buildSampleList();
        $this->assertNull($students->get(100));
    }

    public function testEmptyListReturnsFalse(): void
    {
        $students = new StudentList();
        $this->assertSame(0, $students->count());
        $this->assertFalse($students->valid());
    }
}
