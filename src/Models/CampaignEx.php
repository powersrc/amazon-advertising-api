<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class CampaignEx extends Campaign
{
    use MergesParentPropertyCasts;

    /**
     * Ad placement.
     *
     * @var string
     */
    public $placement;

    /**
     * The date the campaign was created as epoch time in milliseconds.
     *
     * @var int
     */
    public $creationDate;

    /**
     * The date the campaign was last updated as epoch time in milliseconds.
     *
     * @var int
     */
    public $lastUpdatedDate;

    /**
     * The computed status, accounting for campaign out of budget, policy violations, etc.
     *
     * One of ['CAMPAIGN_ARCHIVED', 'CAMPAIGN_PAUSED', 'CAMPAIGN_STATUS_ENABLED','ADVERTISER_PAYMENT_FAILURE', 'CAMPAIGN_OUT_OF_BUDGET', 'ACCOUNT_OUT_OF_BUDGET']
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
        'placement'       => PrimitiveType::STRING,
        'creationDate'    => PrimitiveType::INT,
        'lastUpdatedDate' => PrimitiveType::INT,
        'servingStatus'   => PrimitiveType::STRING,
    ];
}
