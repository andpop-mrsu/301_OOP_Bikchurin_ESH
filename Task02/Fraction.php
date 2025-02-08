<?php

class Fraction
{
    private int $numerator;
    private int $denominator;

    /**
     * @param int $numerator - числитель
     * @param int $denominator - знаменатель
     */
    public function __construct(int $numerator, int $denominator)
    {
        if ($denominator === 0) {
            throw new InvalidArgumentException("Знаменатель не может быть равен нулю.");
        }

        $this->numerator = $numerator;
        $this->denominator = $denominator;

        $this->normalize();
    }

    private function normalize(): void
    {
        $gcd = $this->gcd(abs($this->numerator), abs($this->denominator));

        $this->numerator /= $gcd;
        $this->denominator /= $gcd;

        if ($this->denominator < 0) {
            $this->numerator *= -1;
            $this->denominator *= -1;
        }
    }

    private function gcd(int $a, int $b): int
    {
        while ($b !== 0) {
            $temp = $a % $b;
            $a = $b;
            $b = $temp;
        }
        return $a;
    }

    public function getNumer(): int
    {
        return $this->numerator;
    }

    public function getDenom(): int
    {
        return $this->denominator;
    }

    public function add(Fraction $frac): Fraction
    {
        $newNumerator = $this->numerator * $frac->getDenom() + $frac->getNumer() * $this->denominator;
        $newDenominator = $this->denominator * $frac->getDenom();
        return new Fraction($newNumerator, $newDenominator);
    }

    public function sub(Fraction $frac): Fraction
    {
        $newNumerator = $this->numerator * $frac->getDenom() - $frac->getNumer() * $this->denominator;
        $newDenominator = $this->denominator * $frac->getDenom();
        return new Fraction($newNumerator, $newDenominator);
    }

    public function __toString(): string
    {
        $wholePart = intdiv($this->numerator, $this->denominator);
        $remainderNumerator = abs($this->numerator % $this->denominator);

        $result = [];

        if ($wholePart !== 0) {
            $result[] = $wholePart;
        }

        if ($remainderNumerator !== 0) {
            $result[] = "{$remainderNumerator}/{$this->denominator}";
        }

        if (empty($result)) {
            return "0";
        }

        $sign = ($this->numerator < 0 && $wholePart == 0) ? "-" : "";
        return $sign . implode("'", $result);
    }

}