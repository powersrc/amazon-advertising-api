<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\KeywordMatchType;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

class Keyword extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the keyword.
     *
     * @var int
     */
    public $keywordId;

    /**
     * The ID of the campaign to which this keyword belongs.
     *
     * @var int
     */
    public $campaignId;

    /**
     * The ID of the campaign to which this keyword belongs.
     *
     * Specified for ad group-level keywords.
     *
     * @var int
     */
    public $adGroupId;

    /**
     * Advertiser-specified state of the keyword.
     *
     * @var State
     */
    public $state;

    /**
     * The expression to match against search queries.
     *
     * @var string
     */
    public $keywordText;

    /**
     * The match type used to match the keyword to search query.
     *
     * @var KeywordMatchType
     */
    public $matchType;

    /**
     * Bid used when ads are sourced using this keyword.
     *
     * Only compatible with biddable match types.
     *
     * @var float
     */
    public $bid;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'keywordId'   => PrimitiveType::INT,
        'campaignId'  => PrimitiveType::INT,
        'adGroupId'   => PrimitiveType::INT,
        'state'       => State::class,
        'keywordText' => PrimitiveType::STRING,
        'matchType'   => KeywordMatchType::class,
        'bid'         => PrimitiveType::FLOAT,
    ];
}
