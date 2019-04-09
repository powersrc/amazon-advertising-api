<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

interface HttpException
{
    /**
     * Returns the HTTP response status code.
     *
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Returns the HTTP response headers.
     *
     * @return array
     */
    public function getHeaders(): array;
}
