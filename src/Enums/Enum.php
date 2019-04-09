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

use BadMethodCallException;
use JsonSerializable;
use PowerSrc\AmazonAdvertisingApi\Support\Arr;
use ReflectionClass;
use ReflectionException;
use UnexpectedValueException;
use function array_keys;
use function array_search;
use function array_values;
use function get_called_class;
use function get_class;
use function in_array;

abstract class Enum implements JsonSerializable
{
    /**
     * Enum value.
     *
     * @var mixed
     */
    protected $value;

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
     * Store existing constants in a static cache per object.
     *
     * @var array
     */
    protected static $cache = [];

    /**
     * Creates a new value of some type.
     *
     * @param mixed $value
     *
     * @throws UnexpectedValueException if incompatible type is given
     * @throws ReflectionException
     */
    public function __construct($value)
    {
        if ($value instanceof static) {
            $this->value = $value->getValue();

            return;
        }

        if ( ! $this->isValid($value)) {
            throw new UnexpectedValueException('Value `' . $value . '` is not part of the enum ' . get_called_class());
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->value;
    }

    /**
     * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @throws BadMethodCallException
     * @throws ReflectionException
     *
     * @return static
     */
    public static function __callStatic(string $name, array $arguments)
    {
        $array = static::toArray();
        if (isset($array[$name]) || Arr::exists($array, $name)) {
            return new static($array[$name]);
        }

        throw new BadMethodCallException("No static method or enum constant '$name' in class " . get_called_class());
    }

    /**
     * Returns the value of the enum.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the enum key (i.e. the constant name).
     *
     * @throws ReflectionException
     *
     * @return string
     */
    public function getKey(): string
    {
        return static::search($this->value);
    }

    /**
     * Compares one Enum with another.
     *
     * This method is final, for more information read https://github.com/myclabs/php-enum/issues/4
     *
     * @param Enum $enum
     *
     * @return bool True if Enums are equal, false if not equal
     */
    final public function equals(Enum $enum): bool
    {
        return $this->getValue() === $enum->getValue() && get_called_class() === get_class($enum);
    }

    /**
     * Returns the names (keys) of all constants in the Enum class.
     *
     * @throws ReflectionException
     *
     * @return string[]
     */
    public static function keys(): array
    {
        return array_keys(static::toArray());
    }

    /**
     * Returns instances of the Enum class of all Enum constants.
     *
     * @throws ReflectionException
     *
     * @return static[] Constant name in key, Enum instance in value
     */
    public static function values(): array
    {
        $values = [];

        foreach (static::toArray() as $key => $value) {
            $values[$key] = new static($value);
        }

        return $values;
    }

    /**
     * Returns all possible values as an array.
     *
     * @throws ReflectionException
     *
     * @return array Constant name in key, constant value in value
     */
    public static function toArray(): array
    {
        $class = get_called_class();
        if ( ! isset(static::$cache[$class])) {
            $reflection            = new ReflectionClass($class);
            static::$cache[$class] = $reflection->getConstants();
        }

        return static::$cache[$class];
    }

    /**
     * Check if is valid enum value.
     *
     * @param mixed $value
     *
     * @throws ReflectionException
     *
     * @return bool
     */
    public static function isValid($value): bool
    {
        return in_array($value, static::toArray(), true);
    }

    /**
     * Check if is valid enum key.
     *
     * @param string $key
     *
     * @throws ReflectionException
     *
     * @return bool
     */
    public static function isValidKey(string $key): bool
    {
        $array = static::toArray();

        return isset($array[$key]) || Arr::exists($array, $key);
    }

    /**
     * Return key for value.
     *
     * @param $value
     *
     * @throws ReflectionException
     *
     * @return int|string|false
     */
    public static function search($value)
    {
        return array_search($value, static::toArray(), true);
    }

    /**
     * Specify data which should be serialized to JSON. This method returns data that can be serialized by json_encode()
     * natively.
     *
     * @return mixed
     *
     * @see http://php.net/manual/en/jsonserializable.jsonserialize.php
     */
    public function jsonSerialize()
    {
        return $this->getValue();
    }

    /**
     * Creates a new value of some type.
     *
     * @param mixed $value
     *
     * @throws ReflectionException
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
     * @throws ReflectionException
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
     * @throws ReflectionException
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
