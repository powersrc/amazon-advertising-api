<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

class ProductAd extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the product ad.
     *
     * @var int
     */
    public $adId;

    /**
     * The ID of the campaign to which this product ad belongs.
     *
     * @var int
     */
    public $campaignId;

    /**
     * The ID of the ad group to which this product ad belongs.
     *
     * @var int
     */
    public $adGroupId;

    /**
     * The SKU for the listed product to be advertised. Either this or the asin must be present.
     *
     * @var string
     */
    public $sku;

    /**
     * The ASIN for the listed product to be advertised.
     *
     * Value of state for asin can only be enabled or paused, archived state not available.
     *
     * @var string
     */
    public $asin;

    /**
     * Advertiser-specified state of the product ad.
     *
     * Value of state for asin can only be enabled or paused, archived state not available.
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
        'adId'       => PrimitiveType::INT,
        'campaignId' => PrimitiveType::INT,
        'adGroupId'  => PrimitiveType::INT,
        'sku'        => PrimitiveType::STRING,
        'asin'       => PrimitiveType::STRING,
        'state'      => State::class,
    ];
}
