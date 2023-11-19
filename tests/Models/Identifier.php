<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Identifier extends BaseModel
{
    public ?string $id;
    public int|float $version;
}
