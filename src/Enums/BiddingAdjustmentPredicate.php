<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static BiddingAdjustmentPredicate PLACEMENT_TOP()
 * @method static BiddingAdjustmentPredicate PLACEMENT_PRODUCT_PAGE()
 */
class BiddingAdjustmentPredicate extends Enum
{
    public const PLACEMENT_TOP          = 'placementTop';
    public const PLACEMENT_PRODUCT_PAGE = 'placementProductPage';

    protected $descriptions = [
        self::PLACEMENT_TOP          => 'Top of search (first page).',
        self::PLACEMENT_PRODUCT_PAGE => 'Product pages',
    ];
}
