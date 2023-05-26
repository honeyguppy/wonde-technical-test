<?php

namespace App\Services\Dto;

class LessonDto {
    public string $id;
    public string $misId;
    public ?string $room;
    public ?string $period;
    public ?string $periodInstanceId;
    public ?string $employee;
    public ?bool $alternative;
    public string $startAt;
    public string $endAt;
    public ?int $dayNumber;
    public string $createdAt;
    public string $updatedAt;
    public ?string $classId;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->misId = $data['mis_id'];
        $this->room = $data['room'];
        $this->period = $data['period'];
        $this->periodInstanceId = $data['period_instance_id'];
        $this->employee = $data['employee'];
        $this->alternative = $data['alternative'];
        $this->startAt = $data['start_at']['date'];
        $this->endAt = $data['end_at']['date'];
        $this->dayNumber = $data['day_number'];
        $this->createdAt = $data['created_at']['date'];
        $this->updatedAt = $data['updated_at']['date'];
        $this->classId = $data['class_id'] ?? '';
    }
    
    public function toArray(): array {
        return [
            'id' => $this->id,
            'mis_id' => $this->misId,
            'room' => $this->room,
            'period' => $this->period,
            'period_instance_id' => $this->periodInstanceId,
            'employee' => $this->employee,
            'alternative' => $this->alternative,
            'start_at' => [
                'date' => $this->startAt
            ],
            'end_at' => [
                'date' => $this->endAt
            ],
            'day_number' => $this->dayNumber,
            'created_at' => [
                'date' => $this->createdAt
            ],
            'updated_at' => [
                'date' => $this->updatedAt
            ],
            'class_id' => $this->classId,
        ];
    }
    
    public function toRenderArray(): array {
        return [
            'id' => $this->id,
            'start_at' =>  $this->startAt,
            'end_at' => $this->endAt,
            'class_id' => $this->classId,
        ];
    }
}