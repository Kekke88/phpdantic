<?php

declare(strict_types=1);

namespace Kekke88\Phpdantic\Library;

use Kekke88\Phpdantic\BaseModel;
use Kekke88\Phpdantic\Exceptions\TypeCastException;

class TypeCast
{
    public function tryTypeCastValue(mixed &$value, array $types): void
    {
        $valueType = gettype($value);
        if ($valueType === 'double') {
            $valueType = 'float';
        }

        foreach ($types as $type) {
            if ($type === $valueType) {
                return;
            }
        }

        foreach ($types as $type) {
            if (is_scalar($value) && $this->isScalarType($type)) {
                settype($value, $type);
                return;
            }

            if ($this->isBaseModel($type) && $valueType === 'array') {
                $value = new $type($value);
                return;
            }
        }

        throw new TypeCastException("Cannot cast $valueType to");
    }

    private function isBaseModel(string $type): bool
    {
        return class_exists($type) && get_parent_class($type) === BaseModel::class;
    }

    private function isScalarType(string $type): bool
    {
        $scalarTypes = [
            'int',
            'float',
            'string',
            'bool'
        ];

        return in_array($type, $scalarTypes);
    }
}
