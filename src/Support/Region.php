<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Support;

use PowerSrc\AmazonAdvertisingApi\Contracts\Region as RegionInterface;
use PowerSrc\AmazonAdvertisingApi\Enums\RegionCode;

final class Region implements RegionInterface
{
    /**
     * @var RegionCode
     */
    private $regionCode;

    /**
     * @var array
     */
    private $regions = [
        RegionCode::NORTH_AMERICA => [
            'prod'    => 'advertising-api.amazon.com',
            'sandbox' => 'advertising-api-test.amazon.com',
            'token'   => 'api.amazon.com/auth/o2/token',
        ],
        RegionCode::EUROPEAN_UNION => [
            'prod'    => 'advertising-api-eu.amazon.com',
            'sandbox' => 'advertising-api-test.amazon.com',
            'token'   => 'api.amazon.com/auth/o2/token',
        ],
        RegionCode::FAR_EAST => [
            'prod'    => 'advertising-api-fe.amazon.com',
            'sandbox' => 'advertising-api-test.amazon.com',
            'token'   => 'api.amazon.com/auth/o2/token',
        ],
    ];

    public function __construct(RegionCode $regionCode)
    {
        $this->regionCode = $regionCode;
    }

    public function getProdDomain(): string
    {
        return $this->regions[$this->regionCode->getValue()]['prod'];
    }

    public function getSandboxDomain(): string
    {
        return $this->regions[$this->regionCode->getValue()]['sandbox'];
    }

    public function getTokenDomain(): string
    {
        return $this->regions[$this->regionCode->getValue()]['token'];
    }
}
