<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static PrimitiveType INT()
 * @method static PrimitiveType INTEGER()
 * @method static PrimitiveType FLOAT()
 * @method static PrimitiveType DOUBLE()
 * @method static PrimitiveType STRING()
 * @method static PrimitiveType BOOL()
 * @method static PrimitiveType BOOLEAN()
 * @method static PrimitiveType JSON()
 */
class PrimitiveType extends Enum
{
    public const INT     = 'int';
    public const INTEGER = 'integer';
    public const FLOAT   = 'float';
    public const DOUBLE  = 'double';
    public const STRING  = 'string';
    public const BOOL    = 'bool';
    public const BOOLEAN = 'boolean';
    public const JSON    = 'json';
}
