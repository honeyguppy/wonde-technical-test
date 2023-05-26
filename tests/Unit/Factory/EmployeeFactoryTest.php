<?php

use App\Services\Collections\EmployeeCollection;
use App\Services\Dto\EmployeeDto;
use App\Services\Factories\EmployeeFactory;
use Tests\TestCase;

class EmployeeFactoryTest extends TestCase
{
    public function testCreateCollection()
    {
        $data = $this->loadTestData('employee_data.json')['data'];

        $collection = EmployeeFactory::createCollection($data);

        $this->assertInstanceOf(EmployeeCollection::class, $collection);
        $this->assertCount(50, $collection);
    }

    public function testCreateEmployee()
    {
        $data = $this->loadTestData('employee_data.json')['data'][0];

        $employee = EmployeeFactory::createEmployee($data);

        $this->assertInstanceOf(EmployeeDto::class, $employee);
        $this->assertEquals('A2082387062', $employee->id);
        $this->assertCount(9, $employee->classes);
    }
}
