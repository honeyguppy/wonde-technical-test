<?php

namespace App\Services\Factories;

use App\Services\Collections\StudentCollection;
use App\Services\Dto\StudentDto;

class StudentFactory
{
    public static function createCollection(array $data): StudentCollection
    {
        $collection = new StudentCollection();

        foreach ($data as $studentData) {
            $student = self::createStudent($studentData);
            $collection->add($student);
        }

        return $collection;
    }

    public static function createStudent(array $data): StudentDto
    {
        return new StudentDto($data);
    }
}
