<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Reports;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Models\Model;

final class AdGroupReport extends Model
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
    public $impressions;

    /**
     * @var int
     */
    public $clicks;

    /**
     * @var float
     */
    public $cost;

    /**
     * @var float
     */
    public $attributedConversions1d;

    /**
     * @var float
     */
    public $attributedConversions7d;

    /**
     * @var float
     */
    public $attributedConversions14d;

    /**
     * @var float
     */
    public $attributedConversions30d;

    /**
     * @var float
     */
    public $attributedConversions1dSameSKU;

    /**
     * @var float
     */
    public $attributedConversions7dSameSKU;

    /**
     * @var float
     */
    public $attributedConversions14dSameSKU;

    /**
     * @var float
     */
    public $attributedConversions30dSameSKU;

    /**
     * @var float
     */
    public $attributedUnitsOrdered1d;

    /**
     * @var float
     */
    public $attributedUnitsOrdered7d;

    /**
     * @var float
     */
    public $attributedUnitsOrdered14d;

    /**
     * @var float
     */
    public $attributedUnitsOrdered30d;

    /**
     * @var float
     */
    public $attributedSales1d;

    /**
     * @var float
     */
    public $attributedSales7d;

    /**
     * @var float
     */
    public $attributedSales14d;

    /**
     * @var float
     */
    public $attributedSales30d;

    /**
     * @var float
     */
    public $attributedSales1dSameSKU;

    /**
     * @var float
     */
    public $attributedSales7dSameSKU;

    /**
     * @var float
     */
    public $attributedSales14dSameSKU;

    /**
     * @var float
     */
    public $attributedSales30dSameSKU;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'campaignId'                      => PrimitiveType::INT,
        'campaignName'                    => PrimitiveType::STRING,
        'adGroupId'                       => PrimitiveType::INT,
        'adGroupName'                     => PrimitiveType::STRING,
        'impressions'                     => PrimitiveType::INT,
        'clicks'                          => PrimitiveType::INT,
        'cost'                            => PrimitiveType::FLOAT,
        'attributedConversions1d'         => PrimitiveType::FLOAT,
        'attributedConversions7d'         => PrimitiveType::FLOAT,
        'attributedConversions14d'        => PrimitiveType::FLOAT,
        'attributedConversions30d'        => PrimitiveType::FLOAT,
        'attributedConversions1dSameSKU'  => PrimitiveType::FLOAT,
        'attributedConversions7dSameSKU'  => PrimitiveType::FLOAT,
        'attributedConversions14dSameSKU' => PrimitiveType::FLOAT,
        'attributedConversions30dSameSKU' => PrimitiveType::FLOAT,
        'attributedUnitsOrdered1d'        => PrimitiveType::FLOAT,
        'attributedUnitsOrdered7d'        => PrimitiveType::FLOAT,
        'attributedUnitsOrdered14d'       => PrimitiveType::FLOAT,
        'attributedUnitsOrdered30d'       => PrimitiveType::FLOAT,
        'attributedSales1d'               => PrimitiveType::FLOAT,
        'attributedSales7d'               => PrimitiveType::FLOAT,
        'attributedSales14d'              => PrimitiveType::FLOAT,
        'attributedSales30d'              => PrimitiveType::FLOAT,
        'attributedSales1dSameSKU'        => PrimitiveType::FLOAT,
        'attributedSales7dSameSKU'        => PrimitiveType::FLOAT,
        'attributedSales14dSameSKU'       => PrimitiveType::FLOAT,
        'attributedSales30dSameSKU'       => PrimitiveType::FLOAT,
    ];
}
