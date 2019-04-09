<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class SuggestedBid extends Model
{
    use HasPropertyCasts;

    /**
     * The bid recommendation for the keyword.
     *
     * @var float
     */
    public $suggested;

    /**
     * The lower bound bid recommendation.
     *
     * @var float
     */
    public $rangeStart;

    /**
     * The upper bound bid recommendation.
     *
     * @var float
     */
    public $rangeEnd;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'suggested'  => PrimitiveType::FLOAT,
        'rangeStart' => PrimitiveType::FLOAT,
        'rangeEnd'   => PrimitiveType::FLOAT,
    ];
}
