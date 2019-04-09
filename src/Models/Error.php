<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class Error extends Model
{
    use HasPropertyCasts;

    /**
     * @var string
     */
    public $code;

    /**
     * @var string
     */
    public $details;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'code'    => PrimitiveType::STRING,
        'details' => PrimitiveType::STRING,
    ];
}
