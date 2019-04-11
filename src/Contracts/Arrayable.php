<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

interface Arrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
