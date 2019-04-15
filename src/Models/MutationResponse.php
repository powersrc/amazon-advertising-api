<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\ResponseCode;

abstract class MutationResponse extends Model
{
    use HasPropertyCasts;

    /**
     * An enumerated success or error code for machine use.
     *
     * @var ResponseCode
     */
    public $code;

    /**
     * A human-readable description of the error, if unsuccessful.
     *
     * @var string
     */
    public $description;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'code'        => ResponseCode::class,
        'description' => PrimitiveType::STRING,
    ];
}
