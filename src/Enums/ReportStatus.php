<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static ReportStatus SUCCESS()
 * @method static ReportStatus FAILURE()
 * @method static ReportStatus IN_PROGRESS()
 */
class ReportStatus extends Enum
{
    public const SUCCESS     = 'SUCCESS';
    public const FAILURE     = 'FAILURE';
    public const IN_PROGRESS = 'IN_PROGRESS';

    public function isSuccess(): bool
    {
        return $this->getValue() === static::SUCCESS;
    }

    public function isFailure(): bool
    {
        return $this->getValue() === static::FAILURE;
    }

    public function isInProgress(): bool
    {
        return $this->getValue() === static::IN_PROGRESS;
    }
}
