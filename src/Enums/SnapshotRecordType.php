<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static SnapshotRecordType PORTFOLIOS()
 * @method static SnapshotRecordType CAMPAIGNS()
 * @method static SnapshotRecordType AD_GROUPS()
 * @method static SnapshotRecordType PRODUCT_ADS()
 * @method static SnapshotRecordType KEYWORDS()
 * @method static SnapshotRecordType NEGATIVE_KEYWORDS()
 * @method static SnapshotRecordType CAMPAIGN_NEGATIVE_KEYWORDS()
 */
class SnapshotRecordType extends Enum
{
    public const PORTFOLIOS                 = 'portfolios';
    public const CAMPAIGNS                  = 'campaigns';
    public const AD_GROUPS                  = 'adGroups';
    public const PRODUCT_ADS                = 'productAds';
    public const KEYWORDS                   = 'keywords';
    public const NEGATIVE_KEYWORDS          = 'negativeKeywords';
    public const CAMPAIGN_NEGATIVE_KEYWORDS = 'campaignNegativeKeywords';
}
