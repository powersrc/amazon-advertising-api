<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class PortfolioResponse extends MutationResponse
{
    use MergesParentPropertyCasts;

    /**
     * The ID of the portfolio that was created/updated, if successful.
     *
     * @var int
     */
    public $portfolioId;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'portfolioId' => PrimitiveType::INT,
    ];
}
