<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\ReportStatus;

class ReportResponse extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the report that was requested.
     *
     * @var string
     */
    public $reportId;

    /**
     * The record type of the report.
     * It can be campaigns, adGroups, productAds, keywords, asins, or targets.
     *
     * @var string
     */
    public $recordType;

    /**
     * The status of the generation of the report,
     * it can be IN_PROGRESS, SUCCESS or FAILURE.
     *
     * @var ReportStatus
     */
    public $status;

    /**
     * Description of the status.
     *
     * @var string
     */
    public $statusDetails;

    /**
     * The URI from the API service from which a redirect to the report can be found.
     * It's only available if status is SUCCESS.
     *
     * @var string
     */
    public $location;

    /**
     * The size of the report file in bytes.
     * It's only available if status is SUCCESS.
     *
     * @var int
     */
    public $fileSize;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'reportId'      => PrimitiveType::STRING,
        'recordType'    => PrimitiveType::STRING,
        'status'        => ReportStatus::class,
        'statusDetails' => PrimitiveType::STRING,
        'location'      => PrimitiveType::STRING,
        'fileSize'      => PrimitiveType::INT,
    ];

}
