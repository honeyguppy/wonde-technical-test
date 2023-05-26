<?php

namespace App\Services\Collections;

use App\Services\Dto\LessonDto;
use ArrayIterator;
use Illuminate\Support\Carbon;
use IteratorAggregate;

class LessonCollection implements IteratorAggregate
{
    private array $lessons;

    public function __construct()
    {
        $this->lessons = [];
    }

    public function add(LessonDto $lesson): void
    {
        $this->lessons[] = $lesson;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->lessons);
    }

    public function toArray(): array
    {
        return array_map(function (LessonDto $lesson) {
            return $lesson->toArray();
        }, $this->lessons);
    }


    public function toRenderArray(): array
    {
        return array_map(function (LessonDto $lesson) {
            return $lesson->toRenderArray();
        }, $this->lessons);
    }

    public function sortByStartAt(): void
    {
        usort($this->lessons, function ($a, $b) {
            $startAtA = Carbon::parse($a->startAt);
            $startAtB = Carbon::parse($b->startAt);

            if ($startAtA->equalTo($startAtB)) {
                return 0;
            } elseif ($startAtA->lessThan($startAtB)) {
                return -1;
            } else {
                return 1;
            }
        });
    }
}
