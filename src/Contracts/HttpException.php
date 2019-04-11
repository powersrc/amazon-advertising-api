<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

use PowerSrc\AmazonAdvertisingApi\Models\Error;

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

    /**
     * Set the Amazon error response if available.
     *
     * @param Error|null $error
     */
    public function setErrorResponse(?Error $error);

    /**
     * Return the Amazon error response or null if not present.
     *
     * @return Error|null
     */
    public function getErrorResponse(): ?Error;
}
