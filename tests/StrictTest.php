<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\Phpdantic\Exceptions\ValidationException;
use Kekke88\PhpdanticTest\Models\StrictModel;
use PHPUnit\Framework\TestCase;

class StrictTest extends TestCase
{
    public function testStrictTestFailsIfTypeNotSame(): void
    {
        $this->expectException(ValidationException::class);
        $data = [
            'string' => 125,
        ];

        $model = new StrictModel($data, true);
    }
}
