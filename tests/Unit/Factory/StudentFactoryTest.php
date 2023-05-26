<?php

use App\Services\Collections\StudentCollection;
use App\Services\Dto\StudentDto;
use App\Services\Factories\StudentFactory;
use Tests\TestCase;

class StudentFactoryTest extends TestCase
{
    public function testCreateCollection()
    {
        $data = $this->loadTestData('class_data.json')['data']['students']['data'];

        $collection = StudentFactory::createCollection($data);

        $this->assertInstanceOf(StudentCollection::class, $collection);
        $this->assertCount(22, $collection);
    }

    public function testCreateStudent()
    {
        $data = $this->loadTestData('class_data.json')['data']['students']['data'][0];

        $student = StudentFactory::createStudent($data);

        $this->assertInstanceOf(StudentDto::class, $student);
        $this->assertEquals('A1504266511', $student->id);
    }
}
