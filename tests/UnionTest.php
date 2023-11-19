<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\PhpdanticTest\Models\Identifier;
use PHPUnit\Framework\TestCase;

class UnionTest extends TestCase
{
    public function testBaseModelWithUnionTypesDoesNotThrowAnException(): void
    {
        $data = [
            'id' => '8888-FF',
            'version' => 1,
        ];

        $model = new Identifier($data);

        $this->assertEquals('8888-FF', $model->id);
        $this->assertEquals(1, $model->version);

        $data = [
            'version' => 1.525,
        ];

        $model = new Identifier($data);

        $this->assertNull($model->id);
        $this->assertEquals(1.525, $model->version);
    }
}
