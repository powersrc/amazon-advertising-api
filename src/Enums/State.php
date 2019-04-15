<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Enums;

/**
 * @method static State ENABLED()
 * @method static State PAUSED()
 * @method static State ARCHIVED()
 * @method static State DELETED()
 * @method static State PENDING()
 */
class State extends Enum
{
    public const ENABLED  = 'enabled';
    public const PAUSED   = 'paused';
    public const ARCHIVED = 'archived';
    public const DELETED  = 'deleted';
    public const PENDING  = 'pending';

    public function isEnabled(): bool
    {
        return $this->getValue() === self::ENABLED;
    }

    public function isPaused(): bool
    {
        return $this->getValue() === self::PAUSED;
    }

    public function isArchived(): bool
    {
        return $this->getValue() === self::ARCHIVED;
    }

    public function isDeleted(): bool
    {
        return $this->getValue() === self::DELETED;
    }

    public function isPending(): bool
    {
        return $this->getValue() === self::PENDING;
    }
}
