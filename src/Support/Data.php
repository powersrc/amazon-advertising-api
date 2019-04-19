<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use Closure;
use function array_shift;
use function explode;
use function in_array;
use function is_array;
use function is_null;
use function is_object;

final class Data
{
    // Static class, don't allow construction.
    private function __construct()
    {
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

        $key = is_array($key) ? $key : explode('.', $key);

        while ( ! is_null($segment = array_shift($key))) {
            if ($segment === '*') {
                if ( ! is_array($target)) {
                    return static::value($default);
                }

                $result = Arr::pluck($target, $key);

                return in_array('*', $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return static::value($default);
            }
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
