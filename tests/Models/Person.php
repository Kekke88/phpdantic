<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Person extends BaseModel
{
    public string $name;
    public int $age;
    public float $money;
    public bool $isOld;
}
