<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi;

use PowerSrc\AmazonAdvertisingApi\Contracts\HttpRequestAuth;
use PowerSrc\AmazonAdvertisingApi\Contracts\RequestThrottle;
use PowerSrc\AmazonAdvertisingApi\Enums\RegionCode;
use PowerSrc\AmazonAdvertisingApi\Support\Region;
use PowerSrc\AmazonAdvertisingApi\Support\Version;

final class Config
{
    public const APP_NAME = 'Amazon Advertising API PHP Client Library';

    private const API_PROTOCOL = 'https';

    /**
     * Default value of 5000 entities will be returned for Sponsored Products.
     *
     * @var int
     */
    private static $defaultMaxPageSize = 5000;

    /**
     * @var HttpRequestAuth
     */
    private $auth;

    /**
     * @var bool
     */
    private $useSandbox;

    /**
     * @var Region
     */
    private $region;

    /**
     * @var string
     */
    private $apiVersion = Version::API;

    /**
     * @var string
     */
    private $appVersion = Version::APP;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * @var int
     */
    private $connectTimeout = 0;

    /**
     * @var int
     */
    private $timeout        = 3600;

    /**
     * @var RequestThrottle|null
     */
    private $requestThrottle;

    public function __construct(HttpRequestAuth $auth, RegionCode $regionCode, ?RequestThrottle $requestThrottle = null, bool $useSandbox = false)
    {
        $this->auth            = $auth;
        $this->region          = new Region($regionCode);
        $this->requestThrottle = $requestThrottle;
        $this->useSandbox      = $useSandbox;
        $this->userAgent       = self::APP_NAME . ' ' . $this->appVersion;
    }

    public static function getDefaultMaxPageSize(): int
    {
        return self::$defaultMaxPageSize;
    }

    public function shouldUseSandbox(): bool
    {
        return $this->useSandbox;
    }

    public function setConnectTimeout(int $connectTimeout): Config
    {
        $this->connectTimeout = $connectTimeout;

        return $this;
    }

    public function setTimeout(int $timeout): Config
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getHttpRequestAuth(): HttpRequestAuth
    {
        return $this->auth;
    }

    public function getClientId(): string
    {
        return $this->auth->getClientId();
    }

    public function canAuthorize(): bool
    {
        return $this->auth->canAuthorize();
    }

    public function getAuthHeaderName(): string
    {
        return $this->auth->getHeaderName();
    }

    public function getAuthType(): string
    {
        return $this->auth->getAuthType();
    }

    public function getAuthData(): ?string
    {
        return $this->auth->getAuthData();
    }

    public function getRegion(): Region
    {
        return $this->region;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function getAppVersion(): string
    {
        return $this->appVersion;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public function getProtocol(): string
    {
        return self::API_PROTOCOL;
    }

    public function getApiEndpoint(): string
    {
        $domain = $this->useSandbox ? $this->region->getSandboxDomain() : $this->region->getProdDomain();

        return \sprintf('%s://%s/%s/', self::API_PROTOCOL, $domain, $this->apiVersion);
    }

    public function getTokenEndpoint(): string
    {
        return \sprintf('%s://%s', self::API_PROTOCOL, $this->region->getTokenDomain());
    }

    public function getRequestThrottle(): ?RequestThrottle
    {
        return $this->requestThrottle;
    }
}
