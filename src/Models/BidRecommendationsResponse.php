<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\BidRecommendations\BidRecommendationsList;

class BidRecommendationsResponse extends Model
{
    use HasPropertyCasts;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'adGroupId'       => PrimitiveType::INT,
        'recommendations' => BidRecommendationsList::class,
    ];
}
