<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

trait HasProperties
{
    /**
     * Gets the public properties of the object.
     *
     * @throws ReflectionException
     *
     * @return array
     */
    public function getProperties(): array
    {
        $properties = [];
        $fields     = (new ReflectionClass(static::class))->getProperties(ReflectionProperty::IS_PUBLIC);
        foreach ($fields as $field) {
            $properties[$field->getName()] = $field->getValue($this);
        }

        return $properties;
    }
}
