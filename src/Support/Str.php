<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

final class Str
{
    // Static class, don't allow construction.
    private function __construct()
    {
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string|array $needles
     */
    public static function startsWith(string $haystack, $needles): bool
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && \substr($haystack, 0, \strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}
