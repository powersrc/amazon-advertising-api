<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static NegativeKeywordMatchType NEGATIVE_EXACT()
 * @method static NegativeKeywordMatchType NEGATIVE_PHRASE()
 */
class NegativeKeywordMatchType extends Enum
{
    public const NEGATIVE_EXACT  = 'negativeExact';
    public const NEGATIVE_PHRASE = 'negativePhrase';
}
