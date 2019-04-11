<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use PowerSrc\AmazonAdvertisingApi\Contracts\HttpException as HttpExceptionInterface;
use Exception;
use PowerSrc\AmazonAdvertisingApi\Models\Error;
use RuntimeException;

class HttpException extends RuntimeException implements HttpExceptionInterface
{
    private $statusCode;
    private $headers;
    private $errorResponse;

    public function __construct(int $statusCode, string $message = null, Exception $previous = null, array $headers = [], ?int $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->headers    = $headers;

        $this->errorResponse = null;

        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns the HTTP response status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Returns the HTTP response headers.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set response headers.
     *
     * @param array $headers Response headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * Set the Amazon error response if available.
     *
     * @param Error|null $error
     *
     * @return HttpExceptionInterface
     */
    public function setErrorResponse(?Error $error): HttpExceptionInterface
    {
        $this->errorResponse = $error;

        return $this;
    }

    /**
     * Return the Amazon error response or null if not present.
     *
     * @return Error|null
     */
    public function getErrorResponse(): ?Error
    {
        return $this->errorResponse;
    }
}
