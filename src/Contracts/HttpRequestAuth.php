<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Contracts;

/**
 * Provides a means to authorize an HTTP request.
 */
interface HttpRequestAuth
{
    /**
     * Determines whether authentication information is present.
     */
    public function canAuthorize(): bool;

    /**
     * Gets the name of the header needed to use for authorization.
     */
    public function getHeaderName(): string;

    /**
     * Gets the authentication type.
     */
    public function getAuthType(): string;

    /**
     * Gets the authentication data.
     */
    public function getAuthData(): ?string;

    /**
     * Gets the LWA client identifier.
     */
    public function getClientId(): string;
}
