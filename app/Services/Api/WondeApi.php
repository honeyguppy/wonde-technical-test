<?php

namespace App\Services\Api;
use Wonde\Client;
use Wonde\Endpoints\Schools;


class WondeApi 
{
    private Client $client;
    private Schools $school;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client(env('WONDE_TOKEN'));
        $this->school = $this->client->school(env('WONDE_SCHOOL'));
    }

    public function getEmployees(): array
    {
        $employeeFetch = $this->school->employees->all(['classes'], ['has_class' => true]);
        while ($employeeFetch->valid()) {
            $employeesArray[] = $employeeFetch->current();
            $employeeFetch->next();
        }
        return json_decode(json_encode($employeesArray), true);
    }

    public function getClass(string $classId): array
    {
        return json_decode(json_encode($this->school->classes->get($classId, ['lessons', 'students'])), true);
    }
}
