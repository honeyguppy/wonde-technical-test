<?php

namespace Tests\Unit\Dto;

use App\Services\Dto\LessonDto;
use Tests\TestCase;

class LessonDtoTest extends TestCase
{
    public function testToArray()
    {
        $data = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];

        $lessonDto = new LessonDto($data);
        $result = $lessonDto->toArray();

        $expected = [
            'id' => 'A127493575',
            'mis_id' => '21-2023-24166-61635',
            'room' => 'A1418790635',
            'period' => 'A313122702',
            'period_instance_id' => '61635',
            'employee' => 'A2082387062',
            'alternative' => null,
            'start_at' => [
                'date' => '2023-05-26 08:15:00.000000'
            ],
            'end_at' => [
                'date' => '2023-05-26 09:15:00.000000'
            ],
            'day_number' => null,
            'created_at' => [
                'date' => '2022-09-05 14:30:23.000000'
            ],
            'updated_at' => [
                'date' => '2022-09-05 14:30:23.000000'
            ],
            'class_id' => ''
        ];
        

        $this->assertEquals($expected, $result);
    }

    public function testToRenderArray()
    {
        $data = $this->loadTestData('class_data.json')['data']['lessons']['data'][0];

        $lessonDto = new LessonDto($data);
        $result = $lessonDto->toRenderArray();
        
        $expected = [
            'id' => 'A127493575',
            'start_at' => '2023-05-26 08:15:00.000000',
            'end_at' => '2023-05-26 09:15:00.000000',
            'class_id' => ''
        ];
        
        
        $this->assertEquals($expected, $result);
    }
}