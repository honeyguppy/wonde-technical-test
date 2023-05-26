<?php

namespace App\Services\Dto;
use App\Services\Collections\LessonCollection;
use App\Services\Collections\StudentCollection;

class ClassDto {
    public string $id;
    public string $misId;
    public string $name;
    public ?string $code;
    public ?string $description;
    public ?string $subject;
    public ?bool $alternative;
    public ?string $restoredAt;
    public string $createdAt;
    public string $updatedAt;
    public ?StudentCollection $students;
    public ?LessonCollection $lessons;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->misId = $data['mis_id'];
        $this->name = $data['name'];
        $this->code = $data['code'];
        $this->description = $data['description'];
        $this->subject = $data['subject'];
        $this->alternative = $data['alternative'];
        $this->restoredAt = $data['restored_at']['date'] ?? null;
        $this->createdAt = $data['created_at']['date'];
        $this->updatedAt = $data['updated_at']['date'];
        $this->students = $data['students'] ?? null;
        $this->lessons = $data['lessons'] ?? null;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'mis_id' => $this->misId,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description,
            'subject' => $this->subject,
            'alternative' => $this->alternative,
            'restored_at' => [
                'date' => $this->restoredAt
            ],
            'created_at' => [
                'date' => $this->createdAt
            ],
            'updated_at' => [
                'date' => $this->updatedAt
            ],
            'students' => !empty($this->students) ? $this->students->toArray() : null,
            'lessons' => !empty($this->lessons) ? $this->lessons->toArray() : null,
        ];
    }



    public function toRenderArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'students' => !empty($this->students) ? $this->students->toRenderArray() : null,
        ];
    }
}
