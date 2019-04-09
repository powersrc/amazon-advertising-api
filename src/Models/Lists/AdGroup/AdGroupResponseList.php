<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\AdGroup;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasListItemClass;
use PowerSrc\AmazonAdvertisingApi\Models\AdGroupResponse;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ModelList;

class AdGroupResponseList extends ModelList
{
    use HasListItemClass;

    /**
     * Model class of the list items.
     *
     * Must extend the \PowerSrc\AmazonAdvertisingApi\Models\Model class.
     *
     * @var string
     */
    private $model = AdGroupResponse::class;
}
