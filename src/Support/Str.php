<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use function strlen;
use function substr;

final class Str
{
    // Static class, don't allow construction.
    private function __construct()
    {
    }

    /**
     * Determine if a given string starts with a given substring.
     *
     * @param string       $haystack
     * @param string|array $needles
     *
     * @return bool
     */
    public static function startsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ($needle !== '' && substr($haystack, 0, strlen($needle)) === (string) $needle) {
                return true;
            }
        }

        return false;
    }
}
