<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use Exception;

class ServiceUnavailableHttpException extends HttpException
{
    /**
     * ServiceUnavailableHttpException constructor.
     *
     * @param int|string|null $retryAfter
     * @param string|null     $message
     * @param Exception|null  $previous
     * @param int|null        $code
     * @param array           $headers
     */
    public function __construct($retryAfter = null, string $message = null, Exception $previous = null, ?int $code = 0, array $headers = [])
    {
        if ( ! empty($retryAfter)) {
            $headers['Retry-After'] = $retryAfter;
        }

        parent::__construct(503, $message, $previous, $headers, $code);
    }
}
