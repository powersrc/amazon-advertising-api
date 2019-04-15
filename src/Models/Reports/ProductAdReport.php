<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Reports;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasListItemClass;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ModelList;

class ProductAdReport extends ModelList
{
    use HasListItemClass;

    /**
     * Model class of the list items.
     *
     * Must extend the \PowerSrc\AmazonAdvertisingApi\Models\Model class.
     *
     * @var string
     */
    private $model = ProductAdReportRecord::class;
}
