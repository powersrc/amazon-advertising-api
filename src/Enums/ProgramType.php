<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static ProgramType SB()
 * @method static ProgramType SD()
 * @method static ProgramType SP()
 */
class ProgramType extends Enum
{
    public const SB = 'SB'; // Sponsored Brands
    public const SD = 'SD'; // Sponsored Display
    public const SP = 'SP'; // Sponsored Products
}
