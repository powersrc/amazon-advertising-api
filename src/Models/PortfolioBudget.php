<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\CurrencyCode;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class PortfolioBudget extends Model
{
    use HasPropertyCasts;

    /**
     * The budget amount.
     *
     * @var float
     */
    public $amount;

    /**
     * The currency code of the budget.
     *
     * @var CurrencyCode
     */
    public $currencyCode;

    /**
     * The policy of the portfolio.
     *
     * @var string
     */
    public $policy;

    /**
     * The start date of the portfolio.
     *
     * @var string
     */
    public $startDate;

    /**
     * The end date of the portfolio.
     *
     * @var string
     */
    public $endDate;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'amount'       => PrimitiveType::FLOAT,
        'policy'       => PrimitiveType::STRING,
        'startDate'    => PrimitiveType::STRING,
        'endDate'      => PrimitiveType::STRING,
        'currencyCode' => CurrencyCode::class,
    ];
}
