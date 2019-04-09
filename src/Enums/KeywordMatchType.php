<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static KeywordMatchType EXACT()
 * @method static KeywordMatchType PHRASE()
 * @method static KeywordMatchType BROAD()
 */
class KeywordMatchType extends Enum
{
    public const EXACT  = 'exact';
    public const PHRASE = 'phrase';
    public const BROAD  = 'broad';
}
