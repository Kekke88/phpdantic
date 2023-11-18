<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\PhpdanticTest\Models\Tiger;
use PHPUnit\Framework\TestCase;

class NonScalarTest extends TestCase
{
    public function testCanCreateModelWithNonScalarTypes(): void
    {
        $data = [
            'cubs' => ['Lisa', 'Marge', 'Homer'],
            'zoo' => ['name' => 'Dazoo'],
        ];

        $model = new Tiger($data);

        $this->assertEquals(['Lisa', 'Marge', 'Homer'], $model->cubs);
        $this->assertEquals('Dazoo', $model->zoo->name);
    }
}
