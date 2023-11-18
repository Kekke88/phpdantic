<?php

declare(strict_types=1);

namespace Kekke88\Phpdantic;

use Kekke88\Phpdantic\Exceptions\ValidationException;
use Roave\BetterReflection\Reflection\ReflectionProperty;

//use ReflectionProperty;

class BaseModel
{
    final public function __construct(mixed $data)
    {
        $this->setProperties($data);

        $this->checkForMissingProperties();

        print_r($this);
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

                // Missing value, throw exception
                throw new ValidationException("Missing value for property ($key)");
            }
        }
    }

    private function tryTypeCastValue(mixed &$value, string $key, string $type): void
    {
        if (is_scalar($value)) {
            settype($value, $type);
            return;
        }

        $valueType = gettype($value);

        if ($valueType !== $type) {
            print("Value is $value and type is $type" . PHP_EOL);
            // TODO: hämta om det är basemodel och försöka göra en isåf

            if ($valueType === 'array') {
                // Check if type wanted is a BaseModel
                print("Type is $type" . PHP_EOL);
                print("Parent: " . get_parent_class($type) . PHP_EOL);

                if (get_parent_class($type) === BaseModel::class) {
                    print("Parent is BaseModel, trying to create new BaseModel");
                    $value = new $type($value);
                } else {
                    // TODO: Maybe throw other exception, catch it in setproperties and throw this one, to remove $key param?
                    throw new ValidationException("Property $key is invalid, expected BaseModel");
                }
            }
        }
    }

    private function setProperties(mixed $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $reflectionProperty = new \ReflectionProperty($this, $key);
                $expectedType = $reflectionProperty->getType()->getName();

                $this->tryTypeCastValue($value, $key, $expectedType);

                $this->$key = $value;
            }
        }
    }
}
