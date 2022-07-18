<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use ArrayAccess;

final class Arr
{
    private function __construct()
    {
        /* Not instantiable */
    }

    /**
     * Determines if an array is associative.
     *
     * An array is "associative" if it doesn't have sequential numerical keys beginning with zero.
     */
    public static function isAssoc(array $array): bool
    {
        $keys = \array_keys($array);

        return \array_keys($keys) !== $keys;
    }

    /**
     * Determine whether the given value is array accessible.
     *
     * @param mixed $value
     */
    public static function accessible($value): bool
    {
        return \is_array($value) || $value instanceof ArrayAccess;
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @param ArrayAccess|array $array
     * @param string|int        $key
     */
    public static function exists($array, $key): bool
    {
        if ($array instanceof ArrayAccess) {
            return $array->offsetExists($key);
        }

        return \array_key_exists($key, $array);
    }

    /**
     * Collapse an array of arrays into a single array.
     */
    public static function collapse(array $array): array
    {
        $results = [];

        foreach ($array as $values) {
            if ( ! \is_array($values)) {
                continue;
            }

            $results = \array_merge($results, $values);
        }

        return $results;
    }

    /**
     * Check if an item or items exist in an array using "dot" notation.
     *
     * @param ArrayAccess|array $array
     * @param string|array      $keys
     */
    public static function has($array, $keys): bool
    {
        if ($keys === null) {
            return false;
        }

        $keys = (array) $keys;

        if ( ! $array) {
            return false;
        }

        if ($keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if (self::exists($array, $key)) {
                continue;
            }

            foreach (\explode('.', $key) as $segment) {
                if (self::accessible($subKeyArray) && self::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * Pluck an array of values from an array.
     *
     * @param string|array      $value
     * @param string|array|null $key
     */
    public static function pluck(array $array, $value, $key = null): array
    {
        $results = [];

        list($value, $key) = self::explodePluckParameters($value, $key);

        foreach ($array as $item) {
            $itemValue = Data::get($item, $value);

            // If the key is "null", we will just append the value to the array and keep
            // looping. Otherwise, we will key the array using the value of the key we
            // received from the developer. Then we'll return the final array form.
            if (\is_null($key)) {
                $results[] = $itemValue;
            } else {
                $itemKey = Data::get($item, $key);

                if (\is_object($itemKey) && \method_exists($itemKey, '__toString')) {
                    $itemKey = (string) $itemKey;
                }

                $results[$itemKey] = $itemValue;
            }
        }

        return $results;
    }

    /**
     * Explode the "value" and "key" arguments passed to "pluck".
     *
     * @param string|array      $value
     * @param string|array|null $key
     */
    protected static function explodePluckParameters($value, $key): array
    {
        $value = \is_string($value) ? \explode('.', $value) : $value;

        $key = $key === null || \is_array($key) ? $key : \explode('.', $key);

        return [$value, $key];
    }
}
