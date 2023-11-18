<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Tiger extends BaseModel
{
    public array $cubs;
    public Zoo $zoo;
}
