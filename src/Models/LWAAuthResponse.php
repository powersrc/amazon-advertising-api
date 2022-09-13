<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\LWAErrorType;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use ReflectionException;
use stdClass;

class LWAAuthResponse extends Model
{
    use HasPropertyCasts;

    /**
     * The access tokenfor the user account.
     * Maximum size of 2048 bytes.
     *
     * @var string|null
     */
    public $access_token;

    /**
     * The type of token returned. Should be bearer.
     *
     * @var string|null
     */
    public $token_type;

    /**
     * The number of seconds before the access token becomes invalid.
     *
     * @var int|null
     */
    public $expires_in;

    /**
     * The timestamp the access token becomes invalid.
     *
     * @var int|null
     */
    public $validTill;

    /**
     * A refresh token that can be used to request a new access token.
     * Maximum size of 2048 bytes.
     *
     * @var string|null
     */
    public $refresh_token;

    /**
     * An ASCII error code with an error code value.
     *
     * @var LWAErrorType|string|null
     */
    public $error;

    /**
     * A human-readable ASCII string with information about the error.
     *
     * @var string|null
     */
    public $error_description;

    /**
     * A URI to a web page with human-readable information about the error.
     *
     * @var string|null
     */
    public $error_uri;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'access_token'      => PrimitiveType::STRING,
        'token_type'        => PrimitiveType::STRING,
        'expires_in'        => PrimitiveType::INT,
        'refresh_token'     => PrimitiveType::STRING,
        'error_description' => PrimitiveType::STRING,
        'error_uri'         => PrimitiveType::STRING,
    ];

    /**
     * @param array|stdClass $properties
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     */
    public function __construct($properties = [])
    {
        parent::__construct($properties);

        $this->error      = LWAErrorType::isValid($this->error) ? LWAErrorType::for($this->error) : $this->error;
        $this->expires_in = $this->expires_in !== null ? (int) $this->expires_in + time() : $this->expires_in;
    }

    public function isSuccessResponse(): bool
    {
        return ! $this->isErrorResponse();
    }

    public function isErrorResponse(): bool
    {
        return $this->error instanceof LWAErrorType;
    }

    /**
     * Get the http mapped error code based on the error type.
     */
    public function getErrorCode(): int
    {
        return $this->isErrorResponse() ? $this->error->getErrorCode() : 0;
    }
}
