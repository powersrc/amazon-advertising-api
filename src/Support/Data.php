<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use Closure;

final class Data
{
    private function __construct()
    {
        /* Not instantiable */
    }

    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param mixed        $target
     * @param string|array $key
     * @param mixed        $default
     *
     * @return mixed
     */
    public static function get($target, $key, $default = null)
    {
        if ($key === null) {
            return $target;
        }

        $key = \is_array($key) ? $key : \explode('.', $key);

        while ( ! \is_null($segment = \array_shift($key))) {
            if ($segment === '*') {
                if ( ! \is_array($target)) {
                    return self::value($default);
                }

                $result = Arr::pluck($target, $key);

                return \in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];

                continue;
            }

            if (\is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};

                continue;
            }

            return self::value($default);
        }

        return $target;
    }

    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public static function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}
