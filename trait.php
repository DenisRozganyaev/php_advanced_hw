<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once __DIR__ . '/vendor/autoload.php';

trait CalculatorTrait
{
    public function doIt(float $a, float $b): float
    {
        return $a + $b;
    }

    public function minus(float $a, float $b): float
    {
        return $a - $b;
    }
}

trait PercentageTrait
{
    public function doIt(float $number, float $neededPercent): float
    {
        return ($number / 100) * $neededPercent;
    }
}

trait Advanced
{
    use CalculatorTrait, PercentageTrait {
        CalculatorTrait::doIt insteadof PercentageTrait;
        PercentageTrait::doIt as example;
    }

    public function multiplication(float $a, float $b): float
    {
        return $a * $b;
    }

    public function division(float $a, float $b): float
    {
        return $a / $b;
    }
}

class SimpleCalculator
{
    use CalculatorTrait, PercentageTrait {
        CalculatorTrait::doIt insteadof PercentageTrait;
        PercentageTrait::doIt as example;
    }
}

class EngineerCalculator
{
    use Advanced;
}

$calc = new EngineerCalculator();
var_dump($calc->doIt(5, 4));
var_dump($calc->minus(5, 4));
var_dump($calc->example(5, 4));
var_dump($calc->multiplication(5, 4));
var_dump($calc->division(5, 4));

$calc = new SimpleCalculator();
var_dump($calc->doIt(5, 4));
var_dump($calc->minus(5, 4));
var_dump($calc->example(5, 4));
