<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

class AdGroup extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the ad group.
     *
     * @var int
     */
    public $adGroupId;

    /**
     * The name of the ad group.
     *
     * @var string
     */
    public $name;

    /**
     * The ID of the campaign to which this ad group belongs.
     *
     * @var int
     */
    public $campaignId;

    /**
     * The bid used when keywords belonging to this ad group don't specify a bid. Not available for vendors.
     *
     * @var float
     */
    public $defaultBid;

    /**
     * Advertiser-specified state of the ad group.
     *
     * @var State
     */
    public $state;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'adGroupId'  => PrimitiveType::INT,
        'name'       => PrimitiveType::STRING,
        'campaignId' => PrimitiveType::INT,
        'defaultBid' => PrimitiveType::FLOAT,
        'state'      => State::class,
    ];
}
