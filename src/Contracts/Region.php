<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

interface Region
{
    public function getProdDomain(): string;
    public function getSandboxDomain(): string;
    public function getTokenDomain(): string;
}
