<?php

use App\Services\Collections\LessonCollection;
use App\Services\Dto\LessonDto;
use Tests\TestCase;

class LessonCollectionTest extends TestCase
{
    public function testAdd()
    {
        $lessonData1 = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];
        $lessonData2 = $this->loadTestData('class_data.json')['data']['lessons']['data'][1];

        $collection = new LessonCollection();

        $lesson1 = new LessonDto($lessonData1);
        $lesson2 = new LessonDto($lessonData2);

        $collection->add($lesson1);
        $collection->add($lesson2);

        $this->assertCount(2, $collection);
    }
    public function testGetIterator()
    {
        $collection = new LessonCollection();
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function testToArray()
    {
        $lessonData1 = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];
        $lessonData2 = $this->loadTestData('class_data.json')['data']['lessons']['data'][1];

        $collection = new LessonCollection();

        $lesson1 = new LessonDto($lessonData1);
        $lesson2 = new LessonDto($lessonData2);

        $collection->add($lesson1);
        $collection->add($lesson2);

        $result = $collection->toArray();

        $this->assertCount(2, $result);
    }

    public function testToRenderArray()
    {
        $lessonData1 = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];
        $lessonData2 = $this->loadTestData('class_data.json')['data']['lessons']['data'][1];

        $collection = new LessonCollection();

        $lesson1 = new LessonDto($lessonData1);
        $lesson2 = new LessonDto($lessonData2);

        $collection->add($lesson1);
        $collection->add($lesson2);

        $result = $collection->toRenderArray();

        $this->assertCount(2, $result);
    }


    public function testSortByStartAt()
    {
        $lessonData1 = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];
        $lessonData2 = $this->loadTestData('class_data.json')['data']['lessons']['data'][1];
        $lessonData3 = $this->loadTestData('class_data.json')['data']['lessons']['data'][2];

        $collection = new LessonCollection();

        $lesson1 = new LessonDto($lessonData1);
        $lesson2 = new LessonDto($lessonData2);
        $lesson3 = new LessonDto($lessonData3);

        $collection->add($lesson1);
        $collection->add($lesson2);
        $collection->add($lesson3);
        
        $collection->sortByStartAt();
        
        $result = $collection->toArray();

        $this->assertEquals($lesson1->id, $result[2]['id']);
        $this->assertEquals($lesson2->id, $result[0]['id']);
        $this->assertEquals($lesson3->id, $result[1]['id']);
    }
}