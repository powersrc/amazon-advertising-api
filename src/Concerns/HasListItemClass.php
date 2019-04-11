<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

trait HasListItemClass
{
    /**
     * Return the FQCN of the class to cast the list items to.
     *
     * @return string
     */
    public function getListItemClass(): string
    {
        return $this->model;
    }
}
