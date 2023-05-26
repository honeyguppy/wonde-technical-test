<?php

namespace App\Services\Collections;

use App\Services\Dto\ClassDto;
use ArrayIterator;
use IteratorAggregate;

class ClassCollection implements IteratorAggregate
{
    private array $classes;

    public function __construct()
    {
        $this->classes = [];
    }

    public function add(ClassDto $class): void
    {
        $this->classes[] = $class;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->classes);
    }

    public function toArray(): array
    {
        return array_map(function (ClassDto $class) {
            return $class->toArray();
        }, $this->classes);
    }

    public function toRenderArray(): array
    {
        return array_map(function (ClassDto $class) {
            return $class->toRenderArray();
        }, $this->classes);
    }
}
