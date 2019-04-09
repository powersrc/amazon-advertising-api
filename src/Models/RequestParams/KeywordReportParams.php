<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\KeywordReportMetricsList;

final class KeywordReportParams extends ReportParams
{
    /**
     * Return the classname of the requested report's metric list type.
     *
     * @return string
     */
    protected function getMetricsListType(): string
    {
        return KeywordReportMetricsList::class;
    }
}
