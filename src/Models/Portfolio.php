<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

class Portfolio extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the portfolio.
     *
     * @var int
     */
    public $portfolioId;

    /**
     * The name of the portfolio.
     *
     * @var string
     */
    public $name;

    /**
     * The budget of the portfolio.
     *
     * @var PortfolioBudget
     */
    public $budget;

    /**
     * States if the portfolio is still within budget.
     *
     * @var bool
     */
    public $inBudget;

    /**
     * The status of the portfolio.
     *
     * @var State
     */
    public $state;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'portfolioId' => PrimitiveType::INT,
        'name'        => PrimitiveType::STRING,
        'inBudget'    => PrimitiveType::BOOL,
        'budget'      => PortfolioBudget::class,
        'state'       => State::class,
    ];
}
