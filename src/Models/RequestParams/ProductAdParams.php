<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Config;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class ProductAdParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'startIndex'        => null,
        'count'             => null,
        'sku'               => null,
        'asin'              => null,
        'stateFilter'       => [],
        'campaignIdFilter'  => [],
        'adGroupIdFilter'   => [],
        'adIdFilter'        => [],
    ];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [
        'startIndex'        => 'setStartIndex',
        'count'             => 'setCount',
        'sku'               => 'setSku',
        'asin'              => 'setAsin',
        'stateFilter'       => 'addStates',
        'campaignIdFilter'  => 'addCampaignIds',
        'adGroupIdFilter'   => 'addAdGroupIds',
        'adIdFilter'        => 'addProductAdIds',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [
        'stateFilter',
        'campaignIdFilter',
        'adGroupIdFilter',
        'adIdFilter',
    ];

    public function setStartIndex(int $startIndex): self
    {
        $this->params['startIndex'] = $startIndex;

        return $this;
    }

    public function addToStartIndex(int $count): self
    {
        $this->params['startIndex'] += $count;

        return $this;
    }

    public function setCount(int $count): self
    {
        $this->params['count'] = $count;

        return $this;
    }

    public function getCount(): int
    {
        return (int) ($this->params['count'] ?? Config::getDefaultMaxPageSize());
    }

    public function setSku(string $sku): self
    {
        $this->params['sku'] = $sku;

        return $this;
    }

    public function setAsin(string $asin): self
    {
        $this->params['asin'] = $asin;

        return $this;
    }

    /**
     * @param State[] $states
     */
    public function addStates(array $states): self
    {
        $states = (function (State ...$states) {
            return $states;
        })(...$states);

        foreach ($states as $state) {
            $this->addState($state);
        }

        return $this;
    }

    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }

    /**
     * @param int[] $campaigns
     */
    public function addCampaignIds(array $campaigns): self
    {
        $campaigns = (function (int ...$campaigns) {
            return $campaigns;
        })(...$campaigns);

        foreach ($campaigns as $campaignId) {
            $this->addCampaignId($campaignId);
        }

        return $this;
    }

    public function addCampaignId(int $campaignId): self
    {
        $this->params['campaignIdFilter'][] = $campaignId;

        return $this;
    }

    /**
     * @param int[] $adGroupIds
     */
    public function addAdGroupIds(array $adGroupIds): self
    {
        $adGroupIds = (function (int ...$adGroupIds) {
            return $adGroupIds;
        })(...$adGroupIds);

        foreach ($adGroupIds as $adGroupId) {
            $this->addAdGroupId($adGroupId);
        }

        return $this;
    }

    public function addAdGroupId(int $adGroupId): self
    {
        $this->params['adGroupIdFilter'][] = $adGroupId;

        return $this;
    }

    /**
     * @param int[] $adIds
     */
    public function addProductAdIds(array $adIds): self
    {
        $adIds = (function (int ...$adIds) {
            return $adIds;
        })(...$adIds);

        foreach ($adIds as $adGroupId) {
            $this->addAdGroupId($adGroupId);
        }

        return $this;
    }

    public function addProductAdId(int $adId): self
    {
        $this->params['adIdFilter'][] = $adId;

        return $this;
    }
}
