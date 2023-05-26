<?php

namespace App\Services\Factories;

use App\Services\Collections\EmployeeCollection;
use App\Services\Dto\EmployeeDto;

class EmployeeFactory
{
    public static function createCollection(array $data): EmployeeCollection
    {
        $collection = new EmployeeCollection();

        foreach ($data as $employeeData) {
            $employee = self::createEmployee($employeeData);
            $collection->add($employee);
        }

        return $collection;
    }

    public static function createEmployee(array $data): EmployeeDto
    {
        if (!empty($data['classes']['data'])) {
            $data['classes'] = ClassFactory::createCollection($data['classes']['data']);
        }
        return new EmployeeDto($data);
    }
}
