<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest;

use Kekke88\PhpdanticTest\Models\Game;
use PHPUnit\Framework\TestCase;

class MultiLevelModelTest extends TestCase
{
    public function testCanCreateModelWithMultiNestedModels(): void
    {
        $data = [
            'name' => 'Lineage 2',
            'creator' => [
                'name' => 'NCSoft',
                'stakeholder' => [
                    'name' => 'Netmarble',
                    'members' => [
                        'Kim',
                        'Jun',
                    ],
                ],
            ],
        ];

        $model = new Game($data);

        $this->assertEquals('Lineage 2', $model->name);
        $this->assertEquals('NCSoft', $model->creator->name);
        $this->assertEquals('Netmarble', $model->creator->stakeholder->name);
        $this->assertEquals(['Kim', 'Jun'], $model->creator->stakeholder->members);
    }

    public function testCanCreateModelWithMultiNestedModelsWithNullableClass(): void
    {
        $data = [
            'name' => 'Lineage 2',
            'creator' => [
                'name' => 'NCSoft',
            ],
        ];

        $model = new Game($data);

        $this->assertEquals('Lineage 2', $model->name);
        $this->assertEquals('NCSoft', $model->creator->name);
        $this->assertNull($model->creator->stakeholder);
    }
}
