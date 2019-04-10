<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static ResponseCode SUCCESS()
 * @method static ResponseCode INVALID_ARGUMENT()
 * @method static ResponseCode UNAUTHORIZED()
 * @method static ResponseCode FORBIDDEN()
 */
class ResponseCode extends Enum
{
    public const SUCCESS          = 'SUCCESS';
    public const INVALID_ARGUMENT = 'INVALID_ARGUMENT';
    public const UNAUTHORIZED     = 'UNAUTHORIZED';
    public const FORBIDDEN        = 'FORBIDDEN';
}
