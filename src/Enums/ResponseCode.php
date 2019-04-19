<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static ResponseCode SUCCESS()
 * @method static ResponseCode INVALID_ARGUMENT()
 * @method static ResponseCode UNAUTHORIZED()
 * @method static ResponseCode FORBIDDEN()
 * @method static ResponseCode SERVER_IS_BUSY()
 */
class ResponseCode extends Enum
{
    public const SUCCESS          = 'SUCCESS';
    public const INVALID_ARGUMENT = 'INVALID_ARGUMENT';
    public const UNAUTHORIZED     = 'UNAUTHORIZED';
    public const FORBIDDEN        = 'FORBIDDEN';
    public const SERVER_IS_BUSY   = 'SERVER_IS_BUSY';

    public function isSuccess(): bool
    {
        return $this->getValue() === self::SUCCESS;
    }
}
