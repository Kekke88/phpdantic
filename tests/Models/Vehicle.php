<?php

declare(strict_types=1);

namespace Kekke88\PhpdanticTest\Models;

use Kekke88\Phpdantic\BaseModel;

class Vehicle extends BaseModel
{
    public ?string $brand;
    public ?int $releaseYear;
    public ?float $price;
    public ?bool $isAvailable;
}
