<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static ReportRecordType CAMPAIGNS()
 * @method static ReportRecordType AD_GROUPS()
 * @method static ReportRecordType PRODUCT_ADS()
 * @method static ReportRecordType KEYWORDS()
 * @method static ReportRecordType TARGETS()
 * @method static ReportRecordType ASINS()
 */
class ReportRecordType extends Enum
{
    public const CAMPAIGNS   = 'campaigns';
    public const AD_GROUPS   = 'adGroups';
    public const PRODUCT_ADS = 'productAds';
    public const KEYWORDS    = 'keywords';
    public const TARGETS     = 'targets';
    public const ASINS       = 'asins';
}
