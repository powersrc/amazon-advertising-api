<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\CampaignType;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

class Campaign extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the portfolio.
     *
     * @var int
     */
    public $portfolioId;

    /**
     * The ID of the campaign.
     *
     * @var int
     */
    public $campaignId;

    /**
     * Specifies the advertising product managed by this campaign
     * One of ['sponsoredProducts'].
     *
     * @var CampaignType
     */
    public $campaignType;

    /**
     * The name of the campaign.
     *
     * @var string
     */
    public $name;

    /**
     * Differentiates between a keyword-targeted and automatically targeted campaign
     * One of ['manual', 'auto].
     *
     * @var string
     */
    public $targetingType;

    /**
     * Advertiser-specified state of the campaign
     * One of ['enabled', 'paused', 'archived'].
     *
     * @var State
     */
    public $state;

    /**
     * Daily budget for the campaign in dollars.
     *
     * @var float
     */
    public $dailyBudget;

    /**
     * The date the campaign will go or went live as YYYYMMDD.
     *
     * @var string
     */
    public $startDate;

    /**
     * The optional date the campaign will stop running as YYYYMMDD.
     *
     * @var string|null
     */
    public $endDate;

    /**
     * When enabled, Amazon will increase the default bid for your ads that are eligible to appear in this placement.
     *
     * @var bool
     */
    public $premiumBidAdjustment;

    /** @var BiddingStrategy */
    public $bidding;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'portfolioId'          => PrimitiveType::INT,
        'campaignId'           => PrimitiveType::INT,
        'name'                 => PrimitiveType::STRING,
        'dailyBudget'          => PrimitiveType::FLOAT,
        'startDate'            => PrimitiveType::STRING,
        'endDate'              => PrimitiveType::STRING,
        'premiumBidAdjustment' => PrimitiveType::BOOL,
        'bidding'              => BiddingStrategy::class,
        'campaignType'         => CampaignType::class,
        'state'                => State::class,
    ];
}
