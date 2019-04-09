<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\CountryCode;
use PowerSrc\AmazonAdvertisingApi\Enums\CurrencyCode;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;

class Profile extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the profile.
     *
     * @var int
     */
    public $profileId;

    /**
     * The country code identifying the publisher(s) on which ads will run.
     *
     * One of 'US', 'CA', 'UK', 'DE', 'FR', 'IT', 'ES', 'JP'.
     *
     * @var CountryCode
     */
    public $countryCode;

    /**
     * The currency used for all monetary values for entities under this profile.
     *
     * @var CurrencyCode
     */
    public $currencyCode;

    /**
     * The optional budget shared by all entities created under this profile.
     *
     * @var float
     */
    public $dailyBudget;

    /**
     * The tz database time zone used for all date-based campaign management and reporting.
     *
     * @var string
     */
    public $timezone;

    /**
     * @var ProfileAccountInfo
     */
    public $accountInfo;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'profileId'    => PrimitiveType::INT,
        'countryCode'  => CountryCode::class,
        'currencyCode' => CurrencyCode::class,
        'dailyBudget'  => PrimitiveType::FLOAT,
        'timezone'     => PrimitiveType::STRING,
        'accountInfo'  => ProfileAccountInfo::class,
    ];
}
