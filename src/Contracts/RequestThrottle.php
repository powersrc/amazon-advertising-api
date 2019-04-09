<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

interface RequestThrottle
{
    /**
     * Return whether downloads of reports and snapshots should be throttled.
     *
     * If these are throttled then the status request calls will be made
     * until the report or snapshot is completed and then the call
     * to download the results will be made and returned.
     *
     * If these are not throttled then the response will be returned immediately
     * and it will be up to the user to make the subsequent calls to fetch
     * the status and download the report or snapshot data.
     *
     * @return bool
     */
    public function shouldThrottleDownloads(): bool;

    /**
     * Return the maximum number of requests to attempt before failing.
     *
     * If the request is an attempt to download a report or snapshot,
     * the $isDownloadAttempt property will be true.
     *
     * @param bool $isDownloadAttempt
     *
     * @return int
     */
    public function getMaxAttempts(bool $isDownloadAttempt = false): int;

    /**
     * Return the number of microseconds (1,000,000 = 1 second) to snooze before making the next attempt.
     *
     * If the RetryAfter header is present and valid, it will be passed in as seconds to use
     * in the wait calculation if desired. A value of zero (0) is passed otherwise.
     *
     * If the request is an attempt to download a report or snapshot,
     * the $isDownloadAttempt property will be true.
     *
     * @param int  $attempt
     * @param int  $retryAfter
     * @param bool $isDownloadAttempt
     *
     * @return int
     */
    public function getWaitTime(int $attempt, int $retryAfter, bool $isDownloadAttempt = false): int;
}
