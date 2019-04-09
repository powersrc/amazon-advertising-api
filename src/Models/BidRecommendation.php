<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\BidRecommendationMatchType;
use PowerSrc\AmazonAdvertisingApi\Enums\BidRecommendationStatus;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class BidRecommendation extends Model
{
    use HasPropertyCasts;

    /**
     * The resulting status code for retrieving the bid.
     *
     * @var BidRecommendationStatus
     */
    public $code;

    /**
     * The keyword the recommendation was requested for.
     *
     * @var string
     */
    public $keyword;

    /**
     * The match type used to match the keyword to search query.
     *
     * @var BidRecommendationMatchType
     */
    public $matchType;

    /**
     * The suggested bid for the keyword.
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
        'code'         => BidRecommendationStatus::class,
        'keyword'      => PrimitiveType::STRING,
        'matchType'    => BidRecommendationMatchType::class,
        'suggestedBid' => SuggestedBid::class,
    ];
}
