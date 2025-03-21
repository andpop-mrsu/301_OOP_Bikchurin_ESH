<?php

use App\Stack;

function checkIfBalanced(string $expression): bool
{
    $stack = new Stack();
    $pairs = [
        '}' => '{',
        ']' => '[',
        '>' => '<',
        ')' => '(',
    ];

    for ($i = 0, $len = strlen($expression); $i < $len; $i++) {
        $char = $expression[$i];

        if (in_array($char, $pairs)) {
            $stack->push($char);
        } elseif (isset($pairs[$char])) {
            if ($stack->isEmpty() || $stack->pop() !== $pairs[$char]) {
                return false;
            }
        }
    }

    return $stack->isEmpty();
}
