<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\ProfileType;

class ProfileAccountInfo extends Model
{
    use HasPropertyCasts;

    /**
     * The string identifier for the marketplace associated with this profile.
     *
     * This is the same identifier used by MWS.
     *
     * @var string
     */
    public $marketplaceStringId;

    /**
     * The string identifier for the ID associated with this account.
     *
     * @var string
     */
    public $id;

    /**
     * The string identifier for the account name.
     *
     * @var string
     */
    public $name;

    /**
     * The type of account being called.
     *
     * @var ProfileType
     */
    public $type;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'marketplaceStringId'  => PrimitiveType::STRING,
        'id'                   => PrimitiveType::STRING,
        'name'                 => PrimitiveType::STRING,
        'type'                 => ProfileType::class,
    ];
}
