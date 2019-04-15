<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Reports;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\CurrencyCode;
use PowerSrc\AmazonAdvertisingApi\Enums\KeywordMatchType;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Models\Model;

final class AsinReportRecord extends Model
{
    use HasPropertyCasts;

    /**
     * @var int
     */
    public $campaignId;

    /**
     * @var string
     */
    public $campaignName;

    /**
     * @var int
     */
    public $adGroupId;

    /**
     * @var string
     */
    public $adGroupName;

    /**
     * @var int
     */
    public $keywordId;

    /**
     * @var string
     */
    public $keywordText;

    /**
     * @var KeywordMatchType
     */
    public $matchType;

    /**
     * @var CurrencyCode
     */
    public $currency;

    /**
     * @var string
     */
    public $asin;

    /**
     * @var string
     */
    public $otherAsin;

    /**
     * @var string
     */
    public $sku;

    /**
     * @var float
     */
    public $attributedUnitsOrdered1dOtherSKU;

    /**
     * @var float
     */
    public $attributedUnitsOrdered7dOtherSKU;

    /**
     * @var float
     */
    public $attributedUnitsOrdered14dOtherSKU;

    /**
     * @var float
     */
    public $attributedUnitsOrdered30dOtherSKU;

    /**
     * @var float
     */
    public $attributedSales1dOtherSKU;

    /**
     * @var float
     */
    public $attributedSales7dOtherSKU;

    /**
     * @var float
     */
    public $attributedSales14dOtherSKU;

    /**
     * @var float
     */
    public $attributedSales30dOtherSKU;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'campaignId'                              => PrimitiveType::INT,
        'campaignName'                            => PrimitiveType::STRING,
        'adGroupId'                               => PrimitiveType::INT,
        'adGroupName'                             => PrimitiveType::STRING,
        'keywordId'                               => PrimitiveType::INT,
        'keywordText'                             => PrimitiveType::STRING,
        'matchType'                               => KeywordMatchType::class,
        'currency'                                => CurrencyCode::class,
        'asin'                                    => PrimitiveType::STRING,
        'otherAsin'                               => PrimitiveType::STRING,
        'sku'                                     => PrimitiveType::STRING,
        'attributedUnitsOrdered1dOtherSKU'        => PrimitiveType::FLOAT,
        'attributedUnitsOrdered7dOtherSKU'        => PrimitiveType::FLOAT,
        'attributedUnitsOrdered14dOtherSKU'       => PrimitiveType::FLOAT,
        'attributedUnitsOrdered30dOtherSKU'       => PrimitiveType::FLOAT,
        'attributedSales1dOtherSKU'               => PrimitiveType::FLOAT,
        'attributedSales7dOtherSKU'               => PrimitiveType::FLOAT,
        'attributedSales14dOtherSKU'              => PrimitiveType::FLOAT,
        'attributedSales30dOtherSKU'              => PrimitiveType::FLOAT,
    ];
}
