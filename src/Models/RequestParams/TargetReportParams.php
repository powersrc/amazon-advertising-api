<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\TargetReportMetricsList;

final class TargetReportParams extends ReportParams
{
    /**
     * Return the classname of the requested report's metric list type.
     *
     * @return string
     */
    protected function getMetricsListType(): string
    {
        return TargetReportMetricsList::class;
    }
}
