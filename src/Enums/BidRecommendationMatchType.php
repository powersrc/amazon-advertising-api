<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static BidRecommendationMatchType EXACT()
 * @method static BidRecommendationMatchType PHRASE()
 * @method static BidRecommendationMatchType BROAD()
 */
class BidRecommendationMatchType extends Enum
{
    public const EXACT  = 'exact';
    public const PHRASE = 'phrase';
    public const BROAD  = 'broad';
}
