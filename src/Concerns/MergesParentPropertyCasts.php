<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use function array_merge;

trait MergesParentPropertyCasts
{
    /**
     * Return an array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * The type to cast should be a PrimitiveType value or fully qualified class name.
     * If a FQCN is used then the class will be instantiated, passing the value into the constructor.
     *
     * @return array|null
     */
    protected function getPropertyCasts(): ?array
    {
        return array_merge($this->casts, parent::getPropertyCasts());
    }
}
