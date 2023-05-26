<?php

namespace App\Services\Collections;

use App\Services\Dto\EmployeeDto;
use ArrayIterator;
use IteratorAggregate;

class EmployeeCollection implements IteratorAggregate
{
    private array $employees;

    public function __construct()
    {
        $this->employees = [];
    }

    public function add(EmployeeDto $employee): void
    {
        $this->employees[] = $employee;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->employees);
    }

    public function toArray(): array
    {
        return array_map(function (EmployeeDto $employee) {
            return $employee->toArray();
        }, $this->employees);
    }

    public function toRenderArray(): array
    {
        return array_map(function (EmployeeDto $employee) {
            return $employee->toRenderArray();
        }, $this->employees);
    }

    public function findById(string $employeeId): ?EmployeeDto
    {
        $employee = array_filter($this->employees, function (EmployeeDto $employee) use ($employeeId) {
            return $employee->id === $employeeId;
        });

        if (empty($employee)) return null;

        return reset($employee);
    }

    public function sortByName(): void
    {
        usort($this->employees, function (EmployeeDto $a, EmployeeDto $b) {
            return strcmp($a->forename.$a->surname, $b->forename.$b->surname);
        });
    }
}
