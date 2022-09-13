<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

use PowerSrc\AmazonAdvertisingApi\Models\Error;

interface HttpException
{
    /**
     * Returns the HTTP response status code.
     */
    public function getStatusCode(): int;

    /**
     * Returns the HTTP response headers.
     */
    public function getHeaders(): array;

    /**
     * Set the Amazon error response if available.
     */
    public function setErrorResponse(?Error $error): void;

    /**
     * Return the Amazon error response or null if not present.
     */
    public function getErrorResponse(): ?Error;
}
