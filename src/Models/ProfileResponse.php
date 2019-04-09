<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\MergesParentPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class ProfileResponse extends MutationResponse
{
    use MergesParentPropertyCasts;

    /**
     * The ID of the profile that was created/updated, if successful.
     *
     * @var int
     */
    public $profileId;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'profileId' => PrimitiveType::INT,
    ];
}
