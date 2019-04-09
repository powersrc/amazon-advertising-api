<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models;

use PowerSrc\AmazonAdvertisingApi\Concerns\HasPropertyCasts;
use PowerSrc\AmazonAdvertisingApi\Enums\PrimitiveType;
use PowerSrc\AmazonAdvertisingApi\Enums\SnapshotRecordType;
use PowerSrc\AmazonAdvertisingApi\Enums\SnapshotStatus;

class SnapshotResponse extends Model
{
    use HasPropertyCasts;

    /**
     * The ID of the snapshot that was requested.
     *
     * @var string
     */
    public $snapshotId;

    /**
     * The record type of the report.
     * It can be portfolio, campaign, adGroup, productAd, keyword, negativeKeyword, or campaignNegativeKeyword.
     *
     * @var SnapshotRecordType
     */
    public $recordType;

    /**
     * The status of the generation of the snapshot,
     * it can be IN_PROGRESS, SUCCESS or FAILURE.
     *
     * @var SnapshotStatus
     */
    public $status;

    /**
     * Description of the status.
     *
     * @var string
     */
    public $statusDetails;

    /**
     * The URI for the snapshot.
     * It's only available if status is SUCCESS.
     *
     * @var string
     */
    public $location;

    /**
     * TThe size of the snapshot file in bytes.
     * It's only available if status is SUCCESS.
     *
     * @var int
     */
    public $fileSize;

    /**
     * The epoch time for expiration of the snapshot file.
     * It's only available if status is SUCCESS.
     *
     * @var int
     */
    public $expiration;

    /**
     * An array of types to cast values to on object creation.
     *
     * The property to cast is the key and the type to cast to is the value.
     *
     * @var array
     */
    private $casts = [
        'snapshotId'    => PrimitiveType::STRING,
        'recordType'    => SnapshotRecordType::class,
        'status'        => SnapshotStatus::class,
        'statusDetails' => PrimitiveType::STRING,
        'location'      => PrimitiveType::STRING,
        'fileSize'      => PrimitiveType::INT,
        'expiration'    => PrimitiveType::INT,
    ];

}
