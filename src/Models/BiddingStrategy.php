<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\BiddingStrategyType;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\BiddingStrategyAdjustmentList;

class BiddingStrategy extends Model
{
    use HasPropertyCasts;

    /**
     * @var BiddingStrategyType
     */
    public $strategy;

    /**
     * @var BiddingStrategyAdjustmentList
     */
    public $adjustments;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'strategy'    => BiddingStrategyType::class,
        'adjustments' => BiddingStrategyAdjustmentList::class,
    ];
}
