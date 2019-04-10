<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static BiddingStrategyType MANUAL()
 * @method static BiddingStrategyType AUTO_FOR_SALES()
 * @method static BiddingStrategyType LEGACY_FOR_SALES()
 */
class BiddingStrategyType extends Enum
{
    public const MANUAL           = 'manual';
    public const AUTO_FOR_SALES   = 'autoForSales';
    public const LEGACY_FOR_SALES = 'legacyForSales';

    protected $descriptions = [
        self::MANUAL           => 'Uses your exact bid and any placement adjustments you set, and is not subject to dynamic bidding.',
        self::AUTO_FOR_SALES   => 'Increases or decreases your bids in real time by a maximum of 100%. With this setting bids increase when your ad is more likely to convert to a sale, and bids decrease when less likely to convert to a sale.',
        self::LEGACY_FOR_SALES => 'Lowers your bids in real time when your ad may be less likely to convert to a sale. Campaigns created before the release of the bidding controls feature used this setting by default.',
    ];
}
