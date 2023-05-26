<?php

namespace App\Services\Collections;

use App\Services\Dto\StudentDto;
use ArrayIterator;
use IteratorAggregate;

class StudentCollection implements IteratorAggregate
{
    private array $students;

    public function __construct()
    {
        $this->students = [];
    }

    public function add(StudentDto $student): void
    {
        $this->students[] = $student;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->students);
    }

    public function toArray(): array
    {
        return array_map(function (StudentDto $student) {
            return $student->toArray();
        }, $this->students);
    }

    public function toRenderArray(): array
    {
        return array_map(function (StudentDto $student) {
            return $student->toRenderArray();
        }, $this->students);
    }
}
