<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use Exception;

class BadRequestHttpException extends HttpException
{
    public function __construct(string $message = null, Exception $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(400, $message, $previous, $headers, $code);
    }
}
