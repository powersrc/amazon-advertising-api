<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use Exception;

class UnauthorizedHttpException extends HttpException
{
    public function __construct(string $challenge, string $message = null, Exception $previous = null, ?int $code = 0, array $headers = [])
    {
        $headers['WWW-Authenticate'] = $challenge;

        parent::__construct(401, $message, $previous, $headers, $code);
    }
}
