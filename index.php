<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once __DIR__ . '/vendor/autoload.php';

class WheelExceptions extends Exception
{
}

abstract class Transport
{
    protected int|null $wheels = null;

    public function __construct(int $wheels)
    {
        $this->setWheels($wheels);
    }

    abstract public function setWheels(int $wheels);

    public function getWheels(): int
    {
        return $this->wheels;
    }
}

class Car extends Transport
{
    public function setWheels(int $wheels)
    {
        if (($wheels < 2 || $wheels > 10) || $wheels % 2 !== 0) {
            throw new WheelExceptions("The count of wheels should be 4, 6, 8, 10");
        }
        $this->wheels = $wheels;
    }
}

class Bike extends Transport
{
    public function setWheels(int $wheels)
    {
        if ($wheels < 1 || $wheels > 4) {
            throw new Exception("The count of wheels should be more than 0 and less than 5");
        }
        $this->wheels = $wheels;
    }
}

try { # намагається відіграти код всередині

    $car = new Car(12); # Абстрактні класи не мають можливості створювати об'єкти

    echo $car->getWheels();

} catch (Exception $exception) {
    writeLog($exception);
} finally {
    echo "test";
}

function writeLog(Exception $exception)
{
    $fileDirPath = __DIR__ . '/logs';
    $filePath = $fileDirPath . '/test.log';

    if (!file_exists($fileDirPath)) {
        mkdir($fileDirPath, 0777, true);
    }

    $text = sprintf(
        'Class::%s => from file {%s} => on line {%s} => with exception (%s) \n',
        $exception::class,
        $exception->getFile(),
        $exception->getLine(),
        $exception->getMessage()
    );

    file_put_contents($filePath, $text);
}
