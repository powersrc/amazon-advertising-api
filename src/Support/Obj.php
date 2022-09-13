<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use Closure;
use InvalidArgumentException;
use stdClass;

final class Obj
{
    private function __construct()
    {
        /* Not instantiable */
    }

    /**
     * Transposes properties from one object to another.
     *
     * @param object|callable $dest       The destination object or a function gather properties for that object
     * @param object          $source     The source object
     * @param string[]        $properties The properties to transpose
     *
     * @return object
     */
    public static function transpose($dest, $source, string ...$properties)
    {
        if ( ! \is_object($source)) {
            throw new InvalidArgumentException('$source is not an object');
        }

        if ( ! \is_object($dest) && ! \is_callable($dest)) {
            throw new InvalidArgumentException('$dest is not an object or callable');
        }

        if (\is_callable($dest)) {
            $object = new stdClass();
            $dest   = Closure::fromCallable($dest);
            foreach ($properties as $property) {
                if (\property_exists($source, $property)) {
                    $object->{$property} = $dest($property, $source->{$property});
                }
            }

            return $object;
        }

        foreach ($properties as $property) {
            if (\property_exists($source, $property) && \property_exists($dest, $property)) {
                $dest->{$property} = $source->{$property};
            }
        }

        return $dest;
    }
}
