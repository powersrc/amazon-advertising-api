<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Report;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasListItemClass;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ModelList;
use PowerSrc\AmazonAdvertisingApi\Models\Reports\KeywordReport;
use PowerSrc\AmazonAdvertisingApi\Models\Reports\ProductAdReport;

class ProductAdReportList extends ModelList
{
    use HasListItemClass;

    /**
     * Model class of the list items.
     *
     * Must extend the \PowerSrc\AmazonAdvertisingApi\Models\Model class.
     *
     * @var string
     */
    private $model = ProductAdReport::class;
}
