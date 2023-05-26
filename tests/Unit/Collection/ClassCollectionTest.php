<?php

use App\Services\Collections\ClassCollection;
use App\Services\Dto\ClassDto;
use Tests\TestCase;

class ClassCollectionTest extends TestCase
{
    public function testAdd()
    {
        $classData1 = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'][0];
        $classData2 = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'][1];

        $collection = new ClassCollection();

        $class1 = new ClassDto($classData1);
        $class2 = new ClassDto($classData2);

        $collection->add($class1);
        $collection->add($class2);

        $this->assertCount(2, $collection);
    }
    public function testGetIterator()
    {
        $collection = new ClassCollection();
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function testToArray()
    {
        $classData1 = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'][0];
        $classData2 = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'][1];

        $collection = new ClassCollection();

        $class1 = new ClassDto($classData1);
        $class2 = new ClassDto($classData2);

        $collection->add($class1);
        $collection->add($class2);

        $result = $collection->toArray();

        $this->assertCount(2, $result);
    }

    public function testToRenderArray()
    {
        $classData1 = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'][0];
        $classData2 = $this->loadTestData('employee_data.json')['data'][0]['classes']['data'][1];

        $collection = new ClassCollection();

        $class1 = new ClassDto($classData1);
        $class2 = new ClassDto($classData2);

        $collection->add($class1);
        $collection->add($class2);

        $result = $collection->toRenderArray();

        $this->assertCount(2, $result);
    }
}