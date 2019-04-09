<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class AdGroupEx extends AdGroup
{
    use MergesParentPropertyCasts;

    /**
     * The date the adGroup was created as epoch time in milliseconds.
     *
     * @var int
     */
    public $creationDate;

    /**
     * The date the adGroup was last updated as epoch time in milliseconds.
     *
     * @var int
     */
    public $lastUpdatedDate;

    /**
     * The computed status, accounting for out of budget, policy violations, etc.
     *
     * One of ['AD_GROUP_ARCHIVED', 'AD_GROUP_PAUSED', 'AD_GROUP_STATUS_ENABLED', 'AD_POLICING_SUSPENDED', 'CAMPAIGN_OUT_OF_BUDGET', 'CAMPAIGN_PAUSED', 'CAMPAIGN_ARCHIVED', 'CAMPAIGN_INCOMPLETE', 'ACCOUNT_OUT_OF_BUDGET']
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
