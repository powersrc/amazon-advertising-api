<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use InvalidArgumentException;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use function is_string;
use function json_decode;
use function json_encode;
use function preg_replace;
use function ucfirst;

final class CastType
{
    private function __construct()
    {
        // Static class.
    }

    /**
     * Cast a value to a native PHP type.
     *
     * @param PrimitiveType $cast
     * @param mixed         $value
     *
     * @return mixed
     */
    public static function to(PrimitiveType $cast, $value)
    {
        $method = 'to' . ucfirst($cast->getValue());

        return self::$method($value);
    }

    public static function toInt($value): int
    {
        $value = is_string($value) ? preg_replace('/[^0-9.]/', '', $value) : $value;

        return (int) $value;
    }

    public static function toInteger($value): int
    {
        return self::toInt($value);
    }

    public static function toFloat($value): float
    {
        $value = is_string($value) ? preg_replace('/[^0-9.]/', '', $value) : $value;

        return (float) $value;
    }

    public static function toDouble($value): float
    {
        return self::toFloat($value);
    }

    public static function toString($value): string
    {
        return (string) $value;
    }

    public static function toBool($value): bool
    {
        return (bool) $value;
    }

    public static function toBoolean($value): bool
    {
        return self::toBool($value);
    }

    /**
     * Wrapper for json_decode that throws when an error occurs.
     *
     * @param string $json    JSON data to parse
     * @param bool   $assoc   When true, returned objects will be converted into associative arrays
     * @param int    $depth   User specified recursion depth
     * @param int    $options Bitmask of JSON decode options
     *
     * @throws InvalidArgumentException if the JSON cannot be decoded
     *
     * @see http://www.php.net/manual/en/function.json-decode.php
     *
     * @return mixed
     */
    public static function fromJson($json, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        $data = json_decode($json, $assoc, $depth, $options);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException('json_decode error: ' . json_last_error_msg());
        }

        return $data;
    }

    /**
     * Wrapper for JSON encoding that throws when an error occurs.
     *
     * @param mixed $value   The value being encoded
     * @param int   $options JSON encode option bitmask
     * @param int   $depth   Set the maximum depth. Must be greater than zero.
     *
     * @throws InvalidArgumentException if the JSON cannot be encoded
     *
     * @see http://www.php.net/manual/en/function.json-encode.php
     *
     * @return string
     */
    public static function toJson($value, int $options = 0, int $depth = 512)
    {
        $json = json_encode($value, $options, $depth);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException('json_encode error: ' . json_last_error_msg());
        }

        return $json;
    }
}
