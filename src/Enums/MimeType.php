<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static MimeType JSON()
 * @method static MimeType TEXT_PLAIN()
 * @method static MimeType OCTET_STREAM()
 */
class MimeType extends Enum
{
    public const JSON         = 'application/json';
    public const TEXT_PLAIN   = 'text/plain';
    public const OCTET_STREAM = 'application/octet-stream';
}
