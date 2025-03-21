<?php

namespace App;

class Stack implements StackInterface
{
    private array $stack = [];

    public function __construct(...$elems)
    {
        $this->push(...$elems);
    }

    public function push(...$elems): void
    {
        foreach ($elems as $elem) {
            $this->stack[] = $elem;
        }
    }

    public function pop(): mixed
    {
        return $this->isEmpty() ? null : array_pop($this->stack);
    }

    public function top(): mixed
    {
        return $this->isEmpty() ? null : end($this->stack);
    }

    public function isEmpty(): bool
    {
        return empty($this->stack);
    }

    public function copy(): Stack
    {
        return new Stack(...$this->stack);
    }

    public function __toString(): string
    {
        return "[" . implode('->', array_reverse($this->stack)) . "]";
    }
}
