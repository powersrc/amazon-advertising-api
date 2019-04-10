<?php
/**
 * Modified version of Enum class from My C-Labs.
 *
 * @see http://github.com/myclabs/php-enum
 * @version 1.6.6
 *
 * @license http://www.opensource.org/licenses/mit-license.php MIT (see the LICENSE file)
 */

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

use function array_values;

abstract class Enum extends \MyCLabs\Enum\Enum
{
    /**
     * Optional string descriptions of the enum keys.
     *
     * This is an associative array with the key being the enum value and
     * the value being the description of the enum.
     *
     * @var string[]
     */
    protected $descriptions = [];

    /**
     * Creates a new value of some type.
     *
     * @param mixed $value
     *
     * @return static
     */
    public static function for($value): Enum
    {
        return new static($value);
    }

    /**
     * Returns valid string values of all Enum constants.
     *
     * @return string[] Constant values in value
     */
    public static function validValues(): array
    {
        return array_values(self::toArray());
    }

    /**
     * Check if is invalid enum value.
     *
     * @param $value
     *
     * @return bool
     */
    public static function isInvalid($value): bool
    {
        return ! self::isValid($value);
    }

    /**
     * Check if enum value equals value passed.
     *
     * @param mixed $value
     * @param bool  $strict
     *
     * @return bool
     */
    public function valueEquals($value, bool $strict = true): bool
    {
        return $strict ? $this->getValue() === $value : $this->getValue() == $value;
    }

    /**
     * Get the enum description if available.
     *
     * @param null|string $default
     *
     * @return string
     */
    public function description(?string $default = ''): string
    {
        return $this->descriptions[$this->getValue()] ?? $default;
    }
}
