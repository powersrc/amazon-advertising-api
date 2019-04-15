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
     *
     * @return bool
     */
    public function canAuthorize(): bool;

    /**
     * Gets the name of the header needed to use for authorization.
     *
     * @return string
     */
    public function getHeaderName(): string;

    /**
     * Gets the authentication type.
     *
     * @return string
     */
    public function getAuthType(): string;

    /**
     * Gets the authentication data.
     *
     * @return string|null
     */
    public function getAuthData(): ?string;

    /**
     * Gets the LWA client identifier.
     *
     * @return string
     */
    public function getClientId(): string;
}
