<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Zoo extends BaseModel
{
    public string $name;

    public array $phpdanticValidators = [
        'name' => 'validateName',
    ];

    public function validateName($name): bool
    {
        if (str_contains($name, ' ')) {
            return false;
        }

        return true;
    }
}
