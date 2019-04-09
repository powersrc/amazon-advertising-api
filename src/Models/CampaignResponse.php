<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class CampaignResponse extends MutationResponse
{
    use MergesParentPropertyCasts;

    /**
     * The ID of the campaign that was created/updated, if successful.
     *
     * @var int
     */
    public $campaignId;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'campaignId' => PrimitiveType::INT,
    ];
}
