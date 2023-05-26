<?php

use App\Services\Collections\ClassCollection;
use App\Services\Dto\ClassDto;
use App\Services\Factories\ClassFactory;
use Tests\TestCase;

class ClassFactoryTest extends TestCase
{
    public function testCreateCollection()
    {
        $data = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'];

        $collection = ClassFactory::createCollection($data);

        $this->assertInstanceOf(ClassCollection::class, $collection);
        $this->assertCount(9, $collection);
    }

    public function testCreateClass()
    {
        $data = $this->loadTestData('class_data.json')['data'];

        $class = ClassFactory::createClass($data);

        $this->assertInstanceOf(ClassDto::class, $class);
        $this->assertEquals('A1791881234', $class->id);
        $this->assertCount(22, $class->students);
        $this->assertCount(5, $class->lessons);
    }
}
