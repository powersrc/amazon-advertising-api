<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class Error extends Model
{
    use HasPropertyCasts;

    /**
     * An enumerated success or error code for machine use.
     *
     * @var string
     */
    public $code;

    /**
     * A human-readable description of the error, if unsuccessful.
     *
     * API Docs show this as the property name but it is actually sent as `description`,
     * leaving this in the off chance they correct API to match docs.
     *
     * @var string
     */
    public $details;

    /**
     * An Amazon generated identifier for the request.
     *
     * @var string
     */
    public $requestId;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'code'      => PrimitiveType::STRING,
        'details'   => PrimitiveType::STRING,
        'requestId' => PrimitiveType::STRING,
    ];
}
