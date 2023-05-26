<?php

namespace Tests\Unit\Dto;

use App\Services\Dto\StudentDto;
use Tests\TestCase;

class StudentDtoTest extends TestCase
{
    public function testToArray()
    {
        $data = $this->loadTestData('class_data.json')['data']['students']['data'][0];

        $studentDto = new StudentDto($data);
        $result = $studentDto->toArray();

        $expected = [
            'id' => 'A1504266511',
            'upi' => '741c7c6d3a27252f799fea9384884a7a',
            'mis_id' => '12741',
            'initials' => 'MP',
            'surname' => 'Pendry',
            'forename' => 'Mabon',
            'middle_names' => null,
            'legal_surname' => null,
            'legal_forename' => null,
            'gender' => null,
            'date_of_birth' => null,
            'restored_at' => [
                'date' => null
            ],
            'created_at' => [
                'date' => '2019-04-08 14:09:01.000000'
            ],
            'updated_at' => [
                'date' => '2023-05-20 05:07:27.000000'
            ]
        ];
        
        

        $this->assertEquals($expected, $result);
    }

    public function testToRenderArray()
    {
        $data = $this->loadTestData('class_data.json')['data']['students']['data'][0];

        $studentDto = new StudentDto($data);
        $result = $studentDto->toRenderArray();
        
        $expected = [
            'id' => 'A1504266511',
            'surname' => 'Pendry',
            'forename' => 'Mabon',
        ];
        
        
        $this->assertEquals($expected, $result);
    }
}