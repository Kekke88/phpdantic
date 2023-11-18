<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\Phpdantic\Exceptions\ValidationException;
use Kekke88\PhpdanticTest\Models\Person;
use Kekke88\PhpdanticTest\Models\Vehicle;
use PHPUnit\Framework\TestCase;

class ScalarTest extends TestCase
{
    public function testBaseModelValidatesScalarValues(): void
    {
        $data = [
            'name' => 'Henric Johansson',
            'age' => 35,
            'money' => 100.50,
            'isOld' => true,
        ];

        $model = new Person($data);

        $this->assertEquals('Henric Johansson', $model->name);
        $this->assertEquals(35, $model->age);
        $this->assertEquals(100.50, $model->money);
        $this->assertEquals(true, $model->isOld);
    }

    public function testBaseModelValidatesScalarOptionalValues(): void
    {
        $data = [
            'brand' => 'Volvo',
            'releaseYear' => 1995,
            'isAvailable' => true,
        ];

        $model = new Vehicle($data);

        $this->assertEquals('Volvo', $model->brand);
        $this->assertEquals(1995, $model->releaseYear);
        $this->assertEquals(true, $model->isAvailable);

        $this->assertNull($model->price);
    }

    public function testBaseModelThrowsValidationErrorIfMissingProperty(): void
    {
        $this->expectException(ValidationException::class);

        $model = new Person(['non_existant_property' => 1]);
    }
}
