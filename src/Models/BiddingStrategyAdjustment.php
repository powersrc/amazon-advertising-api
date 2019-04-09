<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class BiddingStrategyAdjustment extends Model
{
    use HasPropertyCasts;

    /** @var string */
    public $predicate;

    /** @var float */
    public $percentage;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'predicate'  => PrimitiveType::STRING,
        'percentage' => PrimitiveType::FLOAT,
    ];
}
