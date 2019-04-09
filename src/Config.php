<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi;

use PowerSrc\AmazonAdvertisingApi\Contracts\HttpRequestAuth;
use PowerSrc\AmazonAdvertisingApi\Contracts\RequestThrottle;
use PowerSrc\AmazonAdvertisingApi\Enums\RegionCode;
use PowerSrc\AmazonAdvertisingApi\Support\Region;
use PowerSrc\AmazonAdvertisingApi\Support\Version;
use function sprintf;

final class Config
{
    public const APP_NAME = 'Amazon Advertising API PHP Client Library';

    private const API_PROTOCOL = 'https';

    /**
     * Default value of 5000 entities will be returned for Sponsored Products.
     *
     * @var int
     */
    private $defaultMaxPageSize = 5000;

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

    /**
     * @return int
     */
    public function getDefaultMaxPageSize(): int
    {
        return $this->defaultMaxPageSize;
    }

    /**
     * @return bool
     */
    public function shouldUseSandbox(): bool
    {
        return $this->useSandbox;
    }

    /**
     * @param int $connectTimeout
     *
     * @return Config
     */
    public function setConnectTimeout(int $connectTimeout): Config
    {
        $this->connectTimeout = $connectTimeout;

        return $this;
    }

    /**
     * @param int $timeout
     *
     * @return Config
     */
    public function setTimeout(int $timeout): Config
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @return HttpRequestAuth
     */
    public function getHttpRequestAuth(): HttpRequestAuth
    {
        return $this->auth;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->auth->getClientId();
    }

    /**
     * @return bool
     */
    public function canAuthorize(): bool
    {
        return $this->auth->canAuthorize();
    }

    /**
     * @return string
     */
    public function getAuthHeaderName(): string
    {
        return $this->auth->getHeaderName();
    }

    /**
     * @return string
     */
    public function getAuthType(): string
    {
        return $this->auth->getAuthType();
    }

    /**
     * @return string|null
     */
    public function getAuthData(): ?string
    {
        return $this->auth->getAuthData();
    }

    /**
     * @return Region
     */
    public function getRegion(): Region
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @return string
     */
    public function getAppVersion(): string
    {
        return $this->appVersion;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @return int
     */
    public function getConnectTimeout(): int
    {
        return $this->connectTimeout;
    }

    /**
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return self::API_PROTOCOL;
    }

    /**
     * @return string
     */
    public function getApiEndpoint(): string
    {
        $domain = $this->useSandbox ? $this->region->getSandboxDomain() : $this->region->getProdDomain();

        return sprintf('%s://%s/%s/', self::API_PROTOCOL, $domain, $this->apiVersion);
    }

    /**
     * @return string
     */
    public function getTokenEndpoint(): string
    {
        return sprintf('%s://%s', self::API_PROTOCOL, $this->region->getTokenDomain());
    }

    /**
     * @return RequestThrottle|null
     */
    public function getRequestThrottle(): ?RequestThrottle
    {
        return $this->requestThrottle;
    }
}
