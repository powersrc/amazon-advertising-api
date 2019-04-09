<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class AdGroupBidRecommendation extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the ad group that a bid was requested for.
     *
     * @var int
     */
    public $adGroupId;

    /**
     * The suggested bid for the ad group.
     *
     * @var SuggestedBid
     */
    public $suggestedBid;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'adGroupId'    => PrimitiveType::INT,
        'suggestedBid' => SuggestedBid::class,
    ];
}
