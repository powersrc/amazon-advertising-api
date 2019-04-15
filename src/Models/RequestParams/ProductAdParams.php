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

    /**
     * @param int $startIndex
     *
     * @return ProductAdParams
     */
    public function setStartIndex(int $startIndex): self
    {
        $this->params['startIndex'] = $startIndex;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return ProductAdParams
     */
    public function addToStartIndex(int $count): self
    {
        $this->params['startIndex'] += $count;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return ProductAdParams
     */
    public function setCount(int $count): self
    {
        $this->params['count'] = $count;

        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return (int) ($this->params['count'] ?? Config::getDefaultMaxPageSize());
    }

    /**
     * @param string $sku
     *
     * @return ProductAdParams
     */
    public function setSku(string $sku): self
    {
        $this->params['sku'] = $sku;

        return $this;
    }

    /**
     * @param string $asin
     *
     * @return ProductAdParams
     */
    public function setAsin(string $asin): self
    {
        $this->params['asin'] = $asin;

        return $this;
    }

    /**
     * @param State[] $states
     *
     * @return ProductAdParams
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

    /**
     * @param State $state
     *
     * @return ProductAdParams
     */
    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }

    /**
     * @param int[] $campaigns
     *
     * @return ProductAdParams
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

    /**
     * @param int $campaignId
     *
     * @return ProductAdParams
     */
    public function addCampaignId(int $campaignId): self
    {
        $this->params['campaignIdFilter'][] = $campaignId;

        return $this;
    }

    /**
     * @param int[] $adGroupIds
     *
     * @return ProductAdParams
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

    /**
     * @param int $adGroupId
     *
     * @return ProductAdParams
     */
    public function addAdGroupId(int $adGroupId): self
    {
        $this->params['adGroupIdFilter'][] = $adGroupId;

        return $this;
    }

    /**
     * @param int[] $adIds
     *
     * @return ProductAdParams
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

    /**
     * @param int $adId
     *
     * @return ProductAdParams
     */
    public function addProductAdId(int $adId): self
    {
        $this->params['adIdFilter'][] = $adId;

        return $this;
    }
}
