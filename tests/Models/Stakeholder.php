<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Stakeholder extends BaseModel
{
    public string $name;
    public array $members;
}
