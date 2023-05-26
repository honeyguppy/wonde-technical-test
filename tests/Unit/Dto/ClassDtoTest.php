<?php

namespace Tests\Unit\Dto;

use App\Services\Dto\ClassDto;
use Tests\TestCase;

class ClassDtoTest extends TestCase
{
    public function testToArray()
    {
        $data = $this->loadTestData('class_data.json')['data'];

        unset($data['students']);
        unset($data['lessons']);

        $classDto = new ClassDto($data);
        $result = $classDto->toArray();

        $expected = [
            'id' => 'A1791881234',
            'mis_id' => '14555',
            'name' => '10y/Re3',
            'code' => null,
            'description' => '10y/Re3',
            'subject' => 'A1349279440',
            'alternative' => null,
            'restored_at' => [
                'date' => null
            ],
            'created_at' => [
                'date' => '2022-09-05 14:21:57.000000'
            ],
            'updated_at' => [
                'date' => '2023-04-04 06:46:30.000000'
            ],
            'students' => null,
            'lessons' => null
        ];

        $this->assertEquals($expected, $result);
    }

    public function testToRenderArray()
    {
        $data = $this->loadTestData('class_data.json')['data'];

        unset($data['students']);
        unset($data['lessons']);

        $classDto = new ClassDto($data);
        $result = $classDto->toRenderArray();

        $expected = [
            'id' => 'A1791881234',
            'name' => '10y/Re3',
            'students' => null
        ];
        
        $this->assertEquals($expected, $result);
    }
}