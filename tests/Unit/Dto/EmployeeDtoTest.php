<?php

namespace Tests\Unit\Dto;

use App\Services\Dto\EmployeeDto;
use Tests\TestCase;

class EmployeeDtoTest extends TestCase
{

    public function testToArray()
    {
        $data = $this->loadTestData('employee_data.json')['data'][0];

        unset($data['classes']);

        $employeeDto = new EmployeeDto($data);
        $result = $employeeDto->toArray();

        $expected = [
            'id' => 'A2082387062',
            'upi' => '18ffacf6d8dbbc9b347d1b752568449f',
            'mis_id' => '1',
            'title' => 'Mr',
            'initials' => 'AB',
            'surname' => 'Blacker',
            'forename' => 'Adrian',
            'middle_names' => null,
            'legal_surname' => 'Blacker',
            'legal_forename' => 'Adrian',
            'gender' => null,
            'date_of_birth' => null,
            'restored_at' => [
                'date' => null
            ],
            'created_at' => [
                'date' => '2016-01-28 14:43:32.000000'
            ],
            'updated_at' => [
                'date' => '2023-05-25 09:09:31.000000'
            ],
            'classes' => null
        ];
        $this->assertEquals($expected, $result);
    }

    public function testToRenderArray()
    {
        $data = $this->loadTestData('employee_data.json')['data'][0];

        unset($data['classes']);

        $employeeDto = new EmployeeDto($data);
        $result = $employeeDto->toRenderArray();

        $expected = [
            'id' => 'A2082387062',
            'surname' => 'Blacker',
            'forename' => 'Adrian'
        ];
        

        $this->assertEquals($expected, $result);
    }
}
