<?php

declare(strict_types=1);

namespace Kekke88\Phpdantic;

use Kekke88\Phpdantic\Exceptions\TypeCastException;
use Kekke88\Phpdantic\Exceptions\ValidationException;
use Kekke88\Phpdantic\Library\TypeCast;
use Kekke88\Phpdantic\Library\Validator;
use ReflectionNamedType;
use ReflectionUnionType;
use Roave\BetterReflection\Reflection\ReflectionProperty;
use TypeError;

class BaseModel
{
    final public function __construct(array $data, bool $strict = false)
    {
        $this->setProperties($data, $strict);

        $this->checkForMissingProperties();

        $this->validateProperties();
    }

    private function setProperties(array $data, bool $strict): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                if ($strict) {
                    try {
                        $this->$key = $value;
                    } catch (TypeError) {
                        throw new ValidationException("Invalid type of property $key, does not match values type");
                    }
                }

                $reflectionProperty = new \ReflectionProperty($this, $key);
                $reflectionTypes = $reflectionProperty->getType();
                $expectedTypes = $this->getExpectedTypes($reflectionTypes);

                $typeCaster = new TypeCast();
                try {
                    $typeCaster->tryTypeCastValue($value, $expectedTypes);
                } catch (TypeCastException) {
                    throw new ValidationException("Invalid value for key $key");
                }

                $this->$key = $value;
            }
        }
    }

    private function checkForMissingProperties(): void
    {
        foreach (get_class_vars($this::class) as $key => $value) {
            if (!isset($this->$key)) {
                $reflectionProperty = ReflectionProperty::createFromInstance($this, $key);

                if ($reflectionProperty->allowsNull() === true) {
                    $this->$key = null;
                    continue;
                }

                throw new ValidationException("Missing value for property ($key)");
            }
        }
    }

    private function validateProperties(): void
    {
        $validatorName = 'phpdanticValidators';

        if (!property_exists($this, $validatorName) || !is_array($this->$validatorName)) {
            return;
        }

        $validator = new Validator();
        $validator->validate($this);
    }

    private function getExpectedTypes(ReflectionNamedType|ReflectionUnionType $reflectionTypes): array
    {
        $expectedTypes = [];

        if ($reflectionTypes instanceof ReflectionUnionType) {
            $unionTypes = $reflectionTypes->getTypes();
            foreach ($unionTypes as $unionType) {
                $expectedTypes[] = $unionType->getName();
            }
        } else {
            $expectedTypes = [$reflectionTypes->getName()];
        }

        return $expectedTypes;
    }
}
