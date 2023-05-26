<?php

use App\Services\Collections\StudentCollection;
use App\Services\Dto\StudentDto;
use Tests\TestCase;

class StudentCollectionTest extends TestCase
{
    public function testAdd()
    {
        $studentData1 = $this->loadTestData('class_data.json')['data']['students']['data'][0];
        $studentData2 = $this->loadTestData('class_data.json')['data']['students']['data'][1];

        $collection = new StudentCollection();

        $student1 = new StudentDto($studentData1);
        $student2 = new StudentDto($studentData2);

        $collection->add($student1);
        $collection->add($student2);

        $this->assertCount(2, $collection);
    }
    public function testGetIterator()
    {
        $collection = new StudentCollection();
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function testToArray()
    {
        $studentData1 = $this->loadTestData('class_data.json')['data']['students']['data'][0];
        $studentData2 = $this->loadTestData('class_data.json')['data']['students']['data'][1];

        $collection = new StudentCollection();

        $student1 = new StudentDto($studentData1);
        $student2 = new StudentDto($studentData2);

        $collection->add($student1);
        $collection->add($student2);

        $result = $collection->toArray();

        $this->assertCount(2, $result);
    }

    public function testToRenderArray()
    {
        $studentData1 = $this->loadTestData('class_data.json')['data']['students']['data'][0];
        $studentData2 = $this->loadTestData('class_data.json')['data']['students']['data'][1];

        $collection = new StudentCollection();

        $student1 = new StudentDto($studentData1);
        $student2 = new StudentDto($studentData2);

        $collection->add($student1);
        $collection->add($student2);

        $result = $collection->toRenderArray();

        $this->assertCount(2, $result);
    }
}