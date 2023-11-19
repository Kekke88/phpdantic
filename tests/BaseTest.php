<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\Phpdantic\Exceptions\ValidationException;
use Kekke88\PhpdanticTest\Models\Person;
use Kekke88\PhpdanticTest\Models\Project;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public function testBaseModelCastsIntToString(): void
    {
        $data = [
            'name' => 1337,
            'age' => 35,
            'money' => 100.50,
            'isOld' => true,
        ];

        $model = new Person($data);

        $this->assertEquals('1337', $model->name);
        $this->assertEquals(35, $model->age);
        $this->assertEquals(100.50, $model->money);
        $this->assertEquals(true, $model->isOld);
    }

    public function testThrowsExceptionIfWeTryToCastIntToObject(): void
    {
        $this->expectException(ValidationException::class);

        $data = [
            'zoo' => 1337,
        ];

        $model = new Project($data);
    }
}
