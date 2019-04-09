<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static State ENABLED()
 * @method static State PAUSED()
 * @method static State ARCHIVED()
 * @method static State PENDING()
 */
class State extends Enum
{
    public const ENABLED  = 'enabled';
    public const PAUSED   = 'paused';
    public const ARCHIVED = 'archived';
    public const PENDING  = 'pending';
}
