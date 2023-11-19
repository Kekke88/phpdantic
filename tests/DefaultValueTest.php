<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\PhpdanticTest\Models\Snake;
use PHPUnit\Framework\TestCase;

class DefaultValueTest extends TestCase
{
    public function testCreatingModelWithEmptyPropertyEqualsDefaultValue(): void
    {
        $data = [];

        $model = new Snake($data);

        $this->assertEquals('Anaconda', $model->name);
        $this->assertEquals(5, $model->id);
    }

    public function testCreatingModelWithDefaultValuesAndSettingThemEqualsToNewValues(): void
    {
        $data = [
            'id' => 1337,
            'name' => 'Rattlesnake',
        ];

        $model = new Snake($data);

        $this->assertEquals(1337, $model->id);
        $this->assertEquals('Rattlesnake', $model->name);
    }
}
