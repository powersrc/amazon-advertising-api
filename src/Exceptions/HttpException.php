<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use PowerSrc\AmazonAdvertisingApi\Contracts\HttpException as HttpExceptionInterface;
use Exception;
use RuntimeException;

class HttpException extends RuntimeException implements HttpExceptionInterface
{
    private $statusCode;
    private $headers;

    public function __construct(int $statusCode, string $message = null, Exception $previous = null, array $headers = [], ?int $code = 0)
    {
        $this->statusCode = $statusCode;
        $this->headers    = $headers;

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
}
