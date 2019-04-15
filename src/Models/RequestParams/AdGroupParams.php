<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Config;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class AdGroupParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'startIndex'        => null,
        'count'             => null,
        'stateFilter'       => [],
        'name'              => null,
        'adGroupIdFilter'   => [],
        'campaignIdFilter'  => [],
    ];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [
        'startIndex'        => 'setStartIndex',
        'count'             => 'setCount',
        'stateFilter'       => 'addStates',
        'name'              => 'setName',
        'adGroupIdFilter'   => 'addAdGroupIds',
        'campaignIdFilter'  => 'addCampaignIds',
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
    ];

    /**
     * @param int $startIndex
     *
     * @return AdGroupParams
     */
    public function setStartIndex(int $startIndex): self
    {
        $this->params['startIndex'] = $startIndex;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return AdGroupParams
     */
    public function addToStartIndex(int $count): self
    {
        $this->params['startIndex'] += $count;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return AdGroupParams
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
     * @param string $name
     *
     * @return AdGroupParams
     */
    public function setName(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    /**
     * @param State[] $states
     *
     * @return AdGroupParams
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
     * @return AdGroupParams
     */
    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }

    /**
     * @param int[] $campaigns
     *
     * @return AdGroupParams
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
     * @return AdGroupParams
     */
    public function addCampaignId(int $campaignId): self
    {
        $this->params['campaignIdFilter'][] = $campaignId;

        return $this;
    }

    /**
     * @param int[] $adGroupIds
     *
     * @return AdGroupParams
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
     * @return AdGroupParams
     */
    public function addAdGroupId(int $adGroupId): self
    {
        $this->params['adGroupIdFilter'][] = $adGroupId;

        return $this;
    }
}
