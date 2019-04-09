<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class KeywordEx extends Keyword
{
    use MergesParentPropertyCasts;

    /**
     * The date the Keyword was created as epoch time in milliseconds.
     *
     * @var int
     */
    public $creationDate;

    /**
     * The date the keyword was last updated as epoch time in milliseconds.
     *
     * @var int
     */
    public $lastUpdatedDate;

    /**
     * The serving status of the keyword.
     *
     * @var string
     */
    public $servingStatus;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'creationDate'    => PrimitiveType::INT,
        'lastUpdatedDate' => PrimitiveType::INT,
        'servingStatus'   => PrimitiveType::STRING,
    ];
}
