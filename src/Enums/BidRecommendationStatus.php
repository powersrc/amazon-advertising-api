<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static BidRecommendationStatus SUCCESS()
 * @method static BidRecommendationStatus NOT_FOUND()
 */
class BidRecommendationStatus extends Enum
{
    public const SUCCESS   = 'SUCCESS';
    public const NOT_FOUND = 'NOT_FOUND';
}
