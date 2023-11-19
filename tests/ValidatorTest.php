<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\Phpdantic\Exceptions\ValidationException;
use Kekke88\PhpdanticTest\Models\BrokenValidator;
use Kekke88\PhpdanticTest\Models\Zoo;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testValidatorAcceptsCorrectProperty(): void
    {
        $data = [
            'name' => 'HenricsZoo',
        ];

        $model = new Zoo($data);

        $this->assertEquals('HenricsZoo', $model->name);
    }

    public function testValidatorsFailCorrectly(): void
    {
        $this->expectException(ValidationException::class);

        $data = [
            'name' => 'Henrics Zoo',
        ];

        $model = new Zoo($data);
    }

    public function testValidatorFailsIfValidateMethodDoesNotExist(): void
    {
        $this->expectException(ValidationException::class);

        $data = [
            'name' => 'Henrics Zoo',
        ];

        $model = new BrokenValidator($data);
    }
}
