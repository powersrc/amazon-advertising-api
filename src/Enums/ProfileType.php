<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static ProfileType SELLER()
 * @method static ProfileType VENDOR()
 * @method static ProfileType AGENCY()
 */
class ProfileType extends Enum
{
    public const SELLER = 'seller';
    public const VENDOR = 'vendor';
    public const AGENCY = 'agency';
}
