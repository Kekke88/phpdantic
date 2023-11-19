<?php

declare(strict_types=1);

namespace Kekke88\Phpdantic\Library;

use Kekke88\Phpdantic\BaseModel;
use Kekke88\Phpdantic\Exceptions\ValidationException;

class Validator
{
    public function validate(BaseModel $class): void
    {
        $validatorName = 'phpdanticValidators';

        foreach ($class->$validatorName as $property => $method) {
            if (!method_exists($class, $method)) {
                throw new ValidationException("Validation method does not exist");
            }
            if (!$class->$method($class->$property)) {
                throw new ValidationException("Validation method $method failed at property $property");
            }
        }
    }
}
