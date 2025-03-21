<?php

use App\Stack;

function runTest()
{
    echo PHP_EOL . "TEST1 (To String test)" . PHP_EOL;
    $stack1 = new Stack(5, 10, 15);
    $expected = '[15->10->5]';
    echo "Ожидается: $expected" . PHP_EOL;
    echo "Получено:   $stack1" . PHP_EOL;
    echo ((string) $stack1 === $expected) ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    echo PHP_EOL . "TEST2 (Constructor test)" . PHP_EOL;
    $stack1 = new Stack('apple', 'banana', 'cherry');
    $expected = '[cherry->banana->apple]';
    echo "Ожидается: $expected" . PHP_EOL;
    echo "Получено:   $stack1" . PHP_EOL;
    echo ((string) $stack1 === $expected) ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    echo PHP_EOL . "TEST3 (Push & Pop test)" . PHP_EOL;
    $stack1->push('date', 'elderberry');
    $expected = '[elderberry->date->cherry->banana->apple]';
    echo "Ожидается: $expected" . PHP_EOL;
    echo "Получено:   $stack1" . PHP_EOL;
    echo ((string) $stack1 === $expected) ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    $popped = $stack1->pop();
    echo "Ожидается: elderberry" . PHP_EOL;
    echo "Получено:   $popped" . PHP_EOL;
    echo ($popped === 'elderberry') ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    echo PHP_EOL . "TEST4 (Top test)" . PHP_EOL;
    $top = $stack1->top();
    echo "Ожидается: date" . PHP_EOL;
    echo "Получено:   $top" . PHP_EOL;
    echo ($top === 'date') ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    echo PHP_EOL . "TEST5 (Empty Stack test)" . PHP_EOL;
    $stack2 = new Stack();
    echo "Ожидается: true" . PHP_EOL;
    echo "Получено:   " . ($stack2->isEmpty() ? 'true' : 'false') . PHP_EOL;
    echo ($stack2->isEmpty()) ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    $stack2->push(null);
    echo "Ожидается: false" . PHP_EOL;
    echo "Получено:   " . ($stack2->isEmpty() ? 'true' : 'false') . PHP_EOL;
    echo (!$stack2->isEmpty()) ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    echo PHP_EOL . "TEST6 (Copy test)" . PHP_EOL;
    $stack3 = new Stack(1, 2, 3);
    $stack4 = $stack3->copy();
    echo "Ожидается: [3->2->1]" . PHP_EOL;
    echo "Получено:   $stack4" . PHP_EOL;
    echo ((string) $stack4 === "[3->2->1]") ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    $stack3->push(4);
    echo "Ожидается: [4->3->2->1]" . PHP_EOL;
    echo "Получено:   $stack3" . PHP_EOL;
    echo ((string) $stack3 === "[4->3->2->1]") ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

    echo "Ожидается: [3->2->1] (копия не изменилась)" . PHP_EOL;
    echo "Получено:   $stack4" . PHP_EOL;
    echo ((string) $stack4 === "[3->2->1]") ? "✅ Тест пройден" : "❌ Тест НЕ ПРОЙДЕН";
    echo PHP_EOL;

}
