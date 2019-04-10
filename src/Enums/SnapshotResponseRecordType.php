<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static SnapshotRecordType PORTFOLIO()
 * @method static SnapshotRecordType CAMPAIGN()
 * @method static SnapshotRecordType AD_GROUP()
 * @method static SnapshotRecordType PRODUCT_AD()
 * @method static SnapshotRecordType KEYWORD()
 * @method static SnapshotRecordType NEGATIVE_KEYWORD()
 * @method static SnapshotRecordType CAMPAIGN_NEGATIVE_KEYWORD()
 */
class SnapshotResponseRecordType extends Enum
{
    public const PORTFOLIO                 = 'portfolio';
    public const CAMPAIGN                  = 'campaign';
    public const AD_GROUP                  = 'adGroup';
    public const PRODUCT_AD                = 'productAd';
    public const KEYWORD                   = 'keyword';
    public const NEGATIVE_KEYWORD          = 'negativeKeyword';
    public const CAMPAIGN_NEGATIVE_KEYWORD = 'campaignNegativeKeyword';
}
