<?php

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

interface EndpointInterface
{
    /**
     * Return the API endpoint.
     *
     * @return string
     */
    public function getApiUrl(): string;

    /**
     * Return the token url.
     *
     * @return string
     */
    public function getTokenUrl(): string;
}
