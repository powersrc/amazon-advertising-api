<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use RuntimeException;
use Throwable;

class ReportGZDecodeError extends RuntimeException
{
    /**
     * Contains the data that triggered the exception.
     *
     * @var string|null
     */
    protected $data;

    /**
     * The URL from which the data may have originated.
     *
     * @var string|null
     */
    protected $url;

    /**
     * Initializes a new instance of the ReportGZDecodeError class.
     */
    public function __construct(string $message = 'Report gzdecode data error.', string $data = null, string $url = null, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
        $this->url  = $url;
    }

    /**
     * Gets the data that triggered the exception.
     */
    final public function getData(): ?string
    {
        return $this->data;
    }

    /**
     * Gets the URL from which the data that triggered the exception came.
     */
    final public function getUrl(): ?string
    {
        return $this->url;
    }
}
