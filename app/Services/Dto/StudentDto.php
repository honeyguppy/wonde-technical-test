<?php

namespace App\Services\Dto;

class StudentDto {
    public string $id;
    public string $upi;
    public string $misId;
    public ?string $initials;
    public ?string $surname;
    public ?string $forename;
    public ?string $middleNames;
    public ?string $legalSurname;
    public ?string $legalForename;
    public ?string $gender;
    public ?string $dateOfBirth;
    public ?string $restoredAt;
    public string $createdAt;
    public string $updatedAt;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->upi = $data['upi'];
        $this->misId = $data['mis_id'];
        $this->initials = $data['initials'];
        $this->surname = $data['surname'];
        $this->forename = $data['forename'];
        $this->middleNames = $data['middle_names'];
        $this->legalSurname = $data['legal_surname'];
        $this->legalForename = $data['legal_forename'];
        $this->gender = $data['gender'];
        $this->dateOfBirth = $data['date_of_birth'];
        $this->restoredAt = $data['restored_at']['date'] ?? null;
        $this->createdAt = $data['created_at']['date'];
        $this->updatedAt = $data['updated_at']['date'];
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'upi' => $this->upi,
            'mis_id' => $this->misId,
            'initials' => $this->initials,
            'surname' => $this->surname,
            'forename' => $this->forename,
            'middle_names' => $this->middleNames,
            'legal_surname' => $this->legalSurname,
            'legal_forename' => $this->legalForename,
            'gender' => $this->gender,
            'date_of_birth' => $this->dateOfBirth,
            'restored_at' => [
                'date' => $this->restoredAt
            ],
            'created_at' => [
                'date' => $this->createdAt
            ],
            'updated_at' => [
                'date' => $this->updatedAt
            ],
        ];
    }

    public function toRenderArray(): array {
        return [
            'id' => $this->id,
            'surname' => $this->surname,
            'forename' => $this->forename,
        ];
    }
}