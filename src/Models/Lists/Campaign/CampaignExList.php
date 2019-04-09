<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasListItemClass;
use PowerSrc\AmazonAdvertisingApi\Models\CampaignEx;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ModelList;

class CampaignExList extends ModelList
{
    use HasListItemClass;

    /**
     * Model class of the list items.
     *
     * Must extend the \PowerSrc\AmazonAdvertisingApi\Models\Model class.
     *
     * @var string
     */
    private $model = CampaignEx::class;
}
