<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use function array_combine;
use function array_filter;
use function array_keys;
use function array_map;
use function array_unique;
use function array_walk;
use function implode;
use function in_array;
use function is_array;
use JsonSerializable;
use PowerSrc\AmazonAdvertisingApi\Contracts\Arrayable;
use PowerSrc\AmazonAdvertisingApi\Support\Arr;

abstract class RequestParams implements Arrayable, JsonSerializable
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [];

    public function __construct(array $params = [])
    {
        array_walk($params, function ($value, $key) {
            if ( ! Arr::exists($this->map, $key)) {
                return;
            }

            $method = $this->map[$key];

            $this->{$method}($value);
        });
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $params = array_filter($this->params/*, function ($param) { return $param !== null; }*/);
        $keys   = array_keys($params);
        $params = array_map(function ($value, $key) {
            if (in_array($key, $this->filters) && Arr::accessible($value)) {
                $value = is_array($value) ? $value : $value->toArray();

                return implode(',', array_unique($value));
            }

            return $value;
        }, $params, $keys);

        return array_combine($keys, $params);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
