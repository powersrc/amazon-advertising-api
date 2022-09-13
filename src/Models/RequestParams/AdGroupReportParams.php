<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\AdGroupReportMetricsList;

final class AdGroupReportParams extends ReportParams
{
    /**
     * Return the classname of the requested report's metric list type.
     */
    protected function getMetricsListType(): string
    {
        return AdGroupReportMetricsList::class;
    }
}
