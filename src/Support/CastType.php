<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

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

    public static function fromJson($value, bool $assoc = false, int $depth = 512, int $options = 0)
    {
        return json_decode($value, $assoc, $depth, $options);
    }

    public static function toJson($value, int $options = 0, int $depth = 512)
    {
        return json_encode($value, $options, $depth);
    }
}
