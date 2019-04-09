<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static LWAErrorType INVALID_REQUEST()
 * @method static LWAErrorType INVALID_CLIENT()
 * @method static LWAErrorType INVALID_GRANT()
 * @method static LWAErrorType UNSUPPORTED_GRANT_TYPE()
 * @method static LWAErrorType UNAUTHORIZED_CLIENT()
 * @method static LWAErrorType ACCESS_DENIED()
 * @method static LWAErrorType UNSUPPORTED_RESPONSE_TYPE()
 * @method static LWAErrorType INVALID_SCOPE()
 * @method static LWAErrorType SERVER_ERROR()
 * @method static LWAErrorType TEMPORARILY_UNAVAILABLE()
 */
class LWAErrorType extends Enum
{
    public const INVALID_REQUEST           = 'invalid_request';
    public const INVALID_CLIENT            = 'invalid_client';
    public const INVALID_GRANT             = 'invalid_grant';
    public const UNSUPPORTED_GRANT_TYPE    = 'unsupported_grant_type';
    public const UNAUTHORIZED_CLIENT       = 'unauthorized_client';
    public const ACCESS_DENIED             = 'access_denied';
    public const UNSUPPORTED_RESPONSE_TYPE = 'unsupported_response_type';
    public const INVALID_SCOPE             = 'invalid_scope';
    public const SERVER_ERROR              = 'server_error';
    public const TEMPORARILY_UNAVAILABLE   = 'temporarily_unavailable';

    protected const CODE_MAP = [
        self::INVALID_REQUEST           => 400,
        self::INVALID_CLIENT            => 401,
        self::INVALID_GRANT             => 406,
        self::UNSUPPORTED_GRANT_TYPE    => 406,
        self::UNAUTHORIZED_CLIENT       => 401,
        self::ACCESS_DENIED             => 403,
        self::UNSUPPORTED_RESPONSE_TYPE => 400,
        self::INVALID_SCOPE             => 400,
        self::SERVER_ERROR              => 500,
        self::TEMPORARILY_UNAVAILABLE   => 503,
    ];

    public function getErrorCode(): int
    {
        return self::CODE_MAP[$this->getValue()];
    }
}
