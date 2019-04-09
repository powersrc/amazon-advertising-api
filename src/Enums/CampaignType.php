<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static CampaignType SPONSORED_PRODUCTS()
 * @method static CampaignType SPONSORED_BRANDS()
 */
class CampaignType extends Enum
{
    public const SPONSORED_PRODUCTS = 'sponsoredProducts';
    public const SPONSORED_BRANDS   = 'sponsoredBrands';
}
