<?php

namespace App\Services\Factories;

use App\Services\Collections\ClassCollection;
use App\Services\Dto\ClassDto;

class ClassFactory
{
    public static function createCollection(array $data): ClassCollection
    {
        $collection = new ClassCollection();

        foreach ($data as $classData) {
            $class = self::createClass($classData);
            $collection->add($class);
        }

        return $collection;
    }

    public static function createClass(array $data): ClassDto
    {
        if (!empty($data['students']['data'])) {
            $data['students'] = StudentFactory::createCollection($data['students']['data']);
        }
        if (!empty($data['lessons']['data'])) {
            $data['lessons'] = LessonFactory::createCollection($data['lessons']['data']);
        }
        return new ClassDto($data);
    }
}
