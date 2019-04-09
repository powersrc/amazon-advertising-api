<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Report;

use PowerSrc\AmazonAdvertisingApi\Enums\ReportRecordType;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ReportMetricsList;

class TargetReportMetricsList extends ReportMetricsList
{
    /**
     * Return an array of valid values for validation of report metrics.
     *
     * @return ReportRecordType
     */
    protected function getReportRecordType(): ReportRecordType
    {
        return ReportRecordType::TARGETS();
    }
}
