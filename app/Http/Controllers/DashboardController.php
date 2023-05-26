<?php

namespace App\Http\Controllers;

use App\Services\Api\WondeApi;
use App\Services\Collections\ClassCollection;
use App\Services\Collections\EmployeeCollection;
use App\Services\Collections\LessonCollection;
use App\Services\Dto\ClassDto;
use App\Services\Dto\EmployeeDto;
use App\Services\Factories\ClassFactory;
use App\Services\Factories\EmployeeFactory;
use App\Services\Factories\LessonFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Inertia\Inertia;
use Inertia\Response;


class DashboardController extends Controller
{
    private WondeApi $client;

    public function __construct(WondeApi $client)
    {
        $this->client = $client ?? new WondeApi();
    }

    public function show(Request $request): Response
    {
        $request->validate([
            'employeeId' => ['string', 'nullable'],
            'date' => ['date', 'nullable']
        ]);

        $selectedDate = new Carbon($request->get('date'), 'UTC') ?? new Carbon();

        $employees = $this->getEmployees();

        $employee = $this->findSelectedEmployeeOrFirst($request, $employees);
        if (empty($employee)) {
            return Inertia::render('Dashboard', [
                'employees' => $employees->toRenderArray(),
                'selectedEmployeeId' => '',
                'selectedDate' => $selectedDate,
                'errors' => [
                    'employeeId' => 'Selected employee does not exist'
                ]
            ]);
        }

        $classes = $this->getEmployeeClassesWithSelectedDateLessons($employee->classes, $selectedDate);

        $lessons = $this->flattenClassLessons($classes);

        return Inertia::render('Dashboard', [
            'employees' => $employees->toRenderArray(),
            'classData' => $classes->toRenderArray(),
            'lessons' => $lessons->toRenderArray(),
            'selectedEmployeeId' => $employee->id,
            'selectedDate' => $selectedDate
        ]);
    }

    private function getEmployees(): EmployeeCollection
    {
        $employeesArray = $this->client->getEmployees();
        $employeesCollection = EmployeeFactory::createCollection($employeesArray);
        $employeesCollection->sortByName();

        return $employeesCollection;
    }

    private function findSelectedEmployeeOrFirst(Request $request, EmployeeCollection $employees): ?EmployeeDto
    {
        if ($request->has('employeeId')){
            return $employees->findById($request->get('employeeId'));
        } else {
            return $employees->getIterator()->current();
        }
    }

    private function getEmployeeClassesWithSelectedDateLessons(ClassCollection $classes, Carbon $selectedDate): ClassCollection
    {
        $classesWithLessons = new ClassCollection();
        foreach ($classes as $class) {
            $classWithLessons = $this->client->getClass($class->id);
    
            $classDto = ClassFactory::createClass($classWithLessons);

            $this->filterNonSelectedDateLessonsFromClass($classDto, $selectedDate);
            
            if ($classDto->lessons->getIterator()->count() === 0) {
                continue;
            }
            $classesWithLessons->add($classDto);
        }
        return $classesWithLessons;
    }

    private function filterNonSelectedDateLessonsFromClass(ClassDto $classDto, Carbon $selectedDate): ClassDto
    {
        $lessons = array_filter($classDto->toArray()['lessons'], function ($lesson) use ($selectedDate) {
            $startDate = new Carbon($lesson['start_at']['date'], 'UTC');
            return $startDate->dayOfYear === $selectedDate->dayOfYear;
        });

        $classDto->lessons = LessonFactory::createCollection($lessons);
        return $classDto;
    }

    private function flattenClassLessons(ClassCollection $classes): LessonCollection
    {
        $lessonsArray = [];
        foreach ($classes as $class) {
            $classIdLessons = $this->setClassIdToLessons($class);
            $lessonsArray = array_merge($lessonsArray, $classIdLessons);
        }

        $lessonsCollection = LessonFactory::createCollection($lessonsArray);
        $lessonsCollection->sortByStartAt();

        return $lessonsCollection;
    }

    private function setClassIdToLessons(ClassDto $class): array
    {
        return array_map(function (array $lesson) use ($class) {
            $lesson['class_id'] = $class->id;
            return $lesson;
        }, $class->lessons->toArray());
    }
}
