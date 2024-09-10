<?php

namespace Crowdproperty\CQRS\DTO;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class DTO
{
    private array $modelIgnoreFields = [
        'id',
        'created_at',
        'updated_at',
    ];

    /**
     * @param Model $model
     * @return static
     */
    public static function fromModel(Model $model): static
    {
        $reflectionClass = new ReflectionClass(static::class);
        $values = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $fieldName = $property->getName();

            /** @phpstan-ignore-next-line  */
            $typeName = $property->getType()->getName();

            if (class_exists($typeName) && str_contains($typeName, config('app.dto_namespace'))) {
                $values[$fieldName] = $model->$fieldName ? $typeName::fromModel($model->$fieldName) : null;

                continue;
            }

            $values[$fieldName] = $model->$fieldName;
        }

        return self::buildFromArray($values);
    }

    private static function buildFromArray(array $values): static
    {
        $class = static::class;

        return new $class(...$values);
    }

    /**
     * @param array $values
     * @return static
     */
    public static function fromArray(array $values): static
    {
        $reflectionClass = new ReflectionClass(static::class);
        $data = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $fieldName = $property->getName();

            /** @phpstan-ignore-next-line  */
            $typeName = $property->getType()->getName();

            if (class_exists($typeName) && str_contains($typeName, config('app.dto_namespace'))) {
                $data[$fieldName] = $values["$fieldName"] ? $typeName::fromArray($values["$fieldName"]) : null;
                continue;
            }

            $data[$fieldName] = $values["$fieldName"];
        }

        return self::buildFromArray($data);
    }

    public function toArray(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        $values = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $fieldName = $property->getName();

            /** @phpstan-ignore-next-line  */
            $typeName = $property->getType()->getName();

            if (class_exists($typeName) && str_contains($typeName, config('app.dto_namespace'))) {
                $values[$fieldName] = $this->$fieldName ? $this->$fieldName->toArray() : null;

                continue;
            }

            $values[$fieldName] = $this->$fieldName;
        }

        return $values;
    }

    public function toModelArray(): array
    {
        $reflectionClass = new ReflectionClass(static::class);
        $values = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $fieldName = $property->getName();

            if (in_array($fieldName, $this->modelIgnoreFields)) {
                continue;
            }

            /** @phpstan-ignore-next-line  */
            $typeName = $property->getType()->getName();

            if (class_exists($typeName) && str_contains($typeName, config('app.dto_namespace'))) {
                $values[$fieldName . '_id'] = $this->$fieldName ? $this->$fieldName->id : null;

                continue;
            }

            $values[$fieldName] = $this->$fieldName;
        }

        return $values;
    }
}
