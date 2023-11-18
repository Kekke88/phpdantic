<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Game extends BaseModel
{
    public string $name;
    public Company $creator;
}
