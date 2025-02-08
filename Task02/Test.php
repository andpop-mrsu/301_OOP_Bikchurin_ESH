<?php
require_once 'Fraction.php';

function runTest()
{
    echo "Старт теста\n";

    $m1 = new Fraction(4, 8);
    $correct = "1/2";
    echo "=== Тест строкового представления ===\n";
    echo "Ожидается: $correct\n";
    echo "Получено: $m1\n";
    if ((string)$m1 === $correct) {
        echo "Тест пройден\n";
    } else {
        echo "Тест НЕ ПРОЙДЕН\n";
    }
    echo "\n";

    $m2 = new Fraction(1, 4);
    $m3 = $m1->add($m2);
    $correct = "3/4";
    echo "=== Тест сложения ===\n";
    echo "Ожидается: $correct\n";
    echo "Получено: $m3\n";
    if ((string)$m3 === $correct) {
        echo "Тест пройден\n";
    } else {
        echo "Тест НЕ ПРОЙДЕН\n";
    }
    echo "\n";

    $m4 = new Fraction(-5, 2);
    $m5 = $m4->sub($m2);
    $correct = "-2'3/4";
    echo "=== Тест вычитания ===\n";
    echo "Ожидается: $correct\n";
    echo "Получено: $m5\n";
    if ((string)$m5 === $correct) {
        echo "Тест пройден\n";
    } else {
        echo "Тест НЕ ПРОЙДЕН\n";
    }
    echo "\n";

    $m6 = new Fraction(-1, 3);
    $m7 = $m1->add($m6);
    $correct = "1/6";
    echo "=== Тест сложения с отрицательной дробью ===\n";
    echo "Ожидается: $correct\n";
    echo "Получено: $m7\n";
    if ((string)$m7 === $correct) {
        echo "Тест пройден\n";
    } else {
        echo "Тест НЕ ПРОЙДЕН\n";
    }
    echo "\n";

    $m8 = new Fraction(1, 2);
    $m9 = $m6->sub($m8);
    $correct = "-5/6";
    echo "=== Тест вычитания с отрицательным результатом ===\n";
    echo "Ожидается: $correct\n";
    echo "Получено: $m9\n";
    if ((string)$m9 === $correct) {
        echo "Тест пройден\n";
    } else {
        echo "Тест НЕ ПРОЙДЕН\n";
    }
    echo "\n";

    echo "=== Тест с нулевым знаменателем ===\n";
    try {
        $m10 = new Fraction(1, 0);
        echo "Получено: $m10\n";
        echo "Тест НЕ ПРОЙДЕН (исключение не было выброшено)\n";
    } catch (InvalidArgumentException $e) {
        echo "Ожидается: Исключение (знаменатель не может быть равен нулю)\n";
        echo "Получено: " . $e->getMessage() . "\n";
        echo "Тест пройден\n";
    }
    echo "\n";
}