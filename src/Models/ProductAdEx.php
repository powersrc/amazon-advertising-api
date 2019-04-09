<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class ProductAdEx extends ProductAd
{
    use MergesParentPropertyCasts;

    /**
     * The date the ad group was created as epoch time in milliseconds.
     *
     * @var int
     */
    public $creationDate;

    /**
     * The date the ad group was last updated as epoch time in milliseconds.
     *
     * @var int
     */
    public $lastUpdatedDate;

    /**
     * The computed status, accounting for out of budget, policy violations, etc.
     *
     * One of ['AD_ARCHIVED', 'AD_PAUSED', 'AD_STATUS_LIVE', 'AD_POLICING_SUSPENDED', 'CAMPAIGN_OUT_OF_BUDGET', 'AD_GROUP_PAUSED', 'AD_GROUP_ARCHIVED', 'CAMPAIGN_PAUSED', 'CAMPAIGN_ARCHIVED', 'ACCOUNT_OUT_OF_BUDGET', 'MISSING_DECORATION']
     *
     * @var string
     */
    public $servingStatus;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'creationDate'    => PrimitiveType::INT,
        'lastUpdatedDate' => PrimitiveType::INT,
        'servingStatus'   => PrimitiveType::STRING,
    ];
}
