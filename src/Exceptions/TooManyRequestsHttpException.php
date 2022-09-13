<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use Exception;

class TooManyRequestsHttpException extends HttpException
{
    /**
     * TooManyRequestsHttpException constructor.
     *
     * @param int|string|null $retryAfter
     */
    public function __construct($retryAfter = null, string $message = null, Exception $previous = null, ?int $code = 0, array $headers = [])
    {
        if ( ! empty($retryAfter)) {
            $headers['Retry-After'] = $retryAfter;
        }

        parent::__construct(429, $message, $previous, $headers, $code);
    }
}
