<?php

use App\Services\Collections\EmployeeCollection;
use App\Services\Dto\EmployeeDto;
use Tests\TestCase;

class EmployeeCollectionTest extends TestCase
{
    public function testAdd()
    {
        $employeeData1 = $this->loadTestData('employee_data.json')['data'][0];
        unset($employeeData1['classes']);
        $employeeData2 = $this->loadTestData('employee_data.json')['data'][1];
        unset($employeeData2['classes']);

        $collection = new EmployeeCollection();

        $employee1 = new EmployeeDto($employeeData1);
        $employee2 = new EmployeeDto($employeeData2);

        $collection->add($employee1);
        $collection->add($employee2);

        $this->assertCount(2, $collection);
    }
    public function testGetIterator()
    {
        $collection = new EmployeeCollection();

        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function testToArray()
    {
        $employeeData1 = $this->loadTestData('employee_data.json')['data'][0];
        unset($employeeData1['classes']);
        $employeeData2 = $this->loadTestData('employee_data.json')['data'][1];
        unset($employeeData2['classes']);

        $collection = new EmployeeCollection();

        $employee1 = new EmployeeDto($employeeData1);
        $employee2 = new EmployeeDto($employeeData2);

        $collection->add($employee1);
        $collection->add($employee2);

        $result = $collection->toArray();

        $this->assertCount(2, $result);
    }

    public function testToRenderArray()
    {
        $employeeData1 = $this->loadTestData('employee_data.json')['data'][0];
        unset($employeeData1['classes']);
        $employeeData2 = $this->loadTestData('employee_data.json')['data'][1];
        unset($employeeData2['classes']);

        $collection = new EmployeeCollection();

        $employee1 = new EmployeeDto($employeeData1);
        $employee2 = new EmployeeDto($employeeData2);

        $collection->add($employee1);
        $collection->add($employee2);

        $result = $collection->toRenderArray();

        $this->assertCount(2, $result);
    }

    public function testFindById()
    {
        $employeeData1 = $this->loadTestData('employee_data.json')['data'][0];
        unset($employeeData1['classes']);
        $employeeData2 = $this->loadTestData('employee_data.json')['data'][1];
        unset($employeeData2['classes']);

        $collection = new EmployeeCollection();

        $employee1 = new EmployeeDto($employeeData1);
        $employee2 = new EmployeeDto($employeeData2);

        $collection->add($employee1);
        $collection->add($employee2);

        $result1 = $collection->findById('A2082387062');
        $result2 = $collection->findById('A921160679');
        $result3 = $collection->findById('DoesNotExist');

        $this->assertEquals($employee1, $result1);
        $this->assertEquals($employee2, $result2);
        $this->assertNull($result3);
    }

    public function testSortByName()
    {
        $employeeData1 = $this->loadTestData('employee_data.json')['data'][0];
        unset($employeeData1['classes']);
        $employeeData2 = $this->loadTestData('employee_data.json')['data'][1];
        unset($employeeData2['classes']);
        $employeeData3 = $this->loadTestData('employee_data.json')['data'][2];
        unset($employeeData3['classes']);

        $collection = new EmployeeCollection();

        $employee1 = new EmployeeDto($employeeData1);
        $employee2 = new EmployeeDto($employeeData2);
        $employee3 = new EmployeeDto($employeeData3);

        $collection->add($employee1);
        $collection->add($employee2);
        $collection->add($employee3);

        $collection->sortByName();

        $result = $collection->toArray();

        $this->assertEquals($employee1->id, $result[0]['id']);
        $this->assertEquals($employee2->id, $result[2]['id']);
        $this->assertEquals($employee3->id, $result[1]['id']);
    }
}