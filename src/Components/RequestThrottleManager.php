<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Components;

use InvalidArgumentException;
use PowerSrc\AmazonAdvertisingApi\Contracts\RequestThrottle;
use function round;

final class RequestThrottleManager implements RequestThrottle
{
    /**
     * @var int
     */
    private $maxAttempts;

    /**
     * @var bool
     */
    private $throttleDownloads;

    /**
     * @var int
     */
    private $maxDownloadAttempts;

    /**
     * @param int  $maxAttempts
     * @param bool $throttleDownloads
     * @param int  $maxDownloadAttempts
     */
    public function __construct(int $maxAttempts = 10, bool $throttleDownloads = true, int $maxDownloadAttempts = 10)
    {
        if ($maxAttempts !== null && $maxAttempts < 1) {
            throw new InvalidArgumentException('Max attempts must be a positive integer > 0, `' . $maxAttempts . '` provided.');
        }

        if ($throttleDownloads === true && $maxDownloadAttempts !== null && $maxDownloadAttempts < 1) {
            throw new InvalidArgumentException('Max download attempts must be a positive integer > 0, `' . $maxDownloadAttempts . '` provided.');
        }

        $this->maxAttempts         = $maxAttempts;
        $this->throttleDownloads   = $throttleDownloads;
        $this->maxDownloadAttempts = $throttleDownloads ? $maxDownloadAttempts : 1;
    }

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
    public function getMaxAttempts(bool $isDownloadAttempt = false): int
    {
        return $isDownloadAttempt ? $this->maxDownloadAttempts : $this->maxAttempts;
    }

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
    public function getWaitTime(int $attempt, int $retryAfter, bool $isDownloadAttempt = false): int
    {
        if ($retryAfter > 0) {
            return $retryAfter * 1000000;
        }

        return $this->getBaseIncrement($isDownloadAttempt) * $this->getMultiplier($attempt);
    }

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
    public function shouldThrottleDownloads(): bool
    {
        return $this->throttleDownloads;
    }

    /**
     * Return the number of microseconds as the base wait time.
     *
     * @param bool $isDownloadAttempt
     *
     * @return int
     */
    protected function getBaseIncrement(bool $isDownloadAttempt): int
    {
        return $isDownloadAttempt ? 7000000 : 250000;
    }

    /**
     * Return the fibonaci position for the current attempt.
     *
     * @param int $attempt
     *
     * @return int
     */
    protected function getMultiplier(int $attempt): int
    {
        return (int) round(((5 ** .5 + 1) / 2) ** $attempt / 5 ** .5);
    }
}
