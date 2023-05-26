<?php

namespace App\Services\Factories;

use App\Services\Collections\LessonCollection;
use App\Services\Dto\LessonDto;

class LessonFactory
{
    public static function createCollection(array $data): LessonCollection
    {
        $collection = new LessonCollection();

        foreach ($data as $lessonData) {
            $lesson = self::createLesson($lessonData);
            $collection->add($lesson);
        }

        return $collection;
    }

    public static function createLesson(array $data): LessonDto
    {
        return new LessonDto($data);
    }
}
