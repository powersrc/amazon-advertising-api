<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static HttpMethod GET()
 * @method static HttpMethod POST()
 * @method static HttpMethod PUT()
 * @method static HttpMethod DELETE()
 */
class HttpMethod extends Enum
{
    public const GET    = 'GET';
    public const POST   = 'POST';
    public const PUT    = 'PUT';
    public const DELETE = 'DELETE';
}
