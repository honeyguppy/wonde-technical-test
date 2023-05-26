<?php

use App\Services\Collections\LessonCollection;
use App\Services\Dto\LessonDto;
use App\Services\Factories\LessonFactory;
use Tests\TestCase;

class LessonFactoryTest extends TestCase
{
    public function testCreateCollection()
    {
        $data = $this->loadTestData('class_data.json')['data']['lessons']['data'];

        $collection = LessonFactory::createCollection($data);

        $this->assertInstanceOf(LessonCollection::class, $collection);
        $this->assertCount(5, $collection);
    }

    public function testCreateLesson()
    {
        $data = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];

        $lesson = LessonFactory::createLesson($data);

        $this->assertInstanceOf(LessonDto::class, $lesson);
        $this->assertEquals('A127493575', $lesson->id);
    }
}
