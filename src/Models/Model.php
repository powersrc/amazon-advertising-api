<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use InvalidArgumentException;
use JsonSerializable;
use PowerSrc\AmazonAdvertisingApi\Concerns\HasProperties;
use PowerSrc\AmazonAdvertisingApi\Contracts\Arrayable;
use PowerSrc\AmazonAdvertisingApi\Contracts\Jsonable;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Support\Arr;
use PowerSrc\AmazonAdvertisingApi\Support\CastType;
use ReflectionException;
use stdClass;

abstract class Model implements Arrayable, JsonSerializable, Jsonable
{
    use HasProperties;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * The type to cast should be a PrimitiveType value or fully qualified class name.
     * If a FQCN is used then the class will be instantiated, passing the value into the constructor.
     *
     * @var array
     */
    protected $propertyCasts;

    /**
     * Initializes a new instance of the Model class.
     *
     * @param array|stdClass $properties
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     */
    public function __construct($properties = [])
    {
        if ($properties instanceof stdClass) {
            $properties = get_object_vars($properties);
        }

        if ( ! is_array($properties)) {
            throw new InvalidArgumentException('Invalid properties argument type, must be one of `array, stdClass`.');
        }

        $this->propertyCasts = $this->getPropertyCasts() ?? [];

        if (count($properties) > 0) {
            $this->fill($properties);
        }
    }

    /**
     * @throws ReflectionException
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * Get the instance as an array.
     *
     * @throws ReflectionException
     *
     * @return array
     */
    public function toArray(): array
    {
        return array_map(function ($value) {
            return $value instanceof Arrayable ? $value->toArray() : $value;
        }, $this->getProperties());
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @throws ReflectionException
     *
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object) array_map(function ($item) {
            if ($item instanceof JsonSerializable) {
                return $item->jsonSerialize();
            }

            if ($item instanceof Jsonable) {
                return CastType::fromJson($item->toJson());
            }

            if ($item instanceof Arrayable) {
                return $item->toArray();
            }

            return CastType::fromJson(CastType::toJson($item));
        }, $this->getProperties());
    }

    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     *
     * @throws ReflectionException
     *
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return CastType::toJson($this->jsonSerialize(), $options);
    }

    /**
     * Fills in the properties of the API model.
     *
     * @param array $properties
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     */
    protected function fill(array $properties = []): void
    {
        $fields = array_keys($this->getProperties());
        foreach ($fields as $field) {
            if (Arr::exists($properties, $field)) {
                $this->{$field} = $this->castProperty($field, $properties[$field]);
            }
        }
    }

    /**
     * Return an array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * The type to cast should be a PrimitiveType value or fully qualified class name.
     * If a FQCN is used then the class will be instantiated, passing the value into the constructor.
     *
     * @return array|null
     */
    abstract protected function getPropertyCasts(): ?array;

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return mixed
     */
    protected function castProperty(string $name, $value)
    {
        if ( ! Arr::exists($this->propertyCasts, $name)) {
            return $value;
        }

        if (PrimitiveType::isValid($this->propertyCasts[$name])) {
            return CastType::to(PrimitiveType::for($this->propertyCasts[$name]), $value);
        }

        if ( ! class_exists($this->propertyCasts[$name])) {
            throw new ClassNotFoundException('Failed to cast property `' . $name . '` to type `' . $this->propertyCasts[$name] . '`.', $this->propertyCasts[$name]);
        }

        return $value instanceof $this->propertyCasts[$name] ? $value : new $this->propertyCasts[$name]($value);
    }
}
