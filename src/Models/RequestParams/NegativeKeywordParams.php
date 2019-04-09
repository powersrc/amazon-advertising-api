<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Enums\NegativeKeywordMatchType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class NegativeKeywordParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'startIndex'        => null,
        'count'             => null,
        'adGroupIdFilter'   => [],
        'campaignIdFilter'  => [],
        'stateFilter'       => [],
        'matchTypeFilter'   => [],
        'keywordText'       => null,
    ];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [
        'startIndex'        => 'setStartIndex',
        'count'             => 'setCount',
        'adGroupIdFilter'   => 'addAdGroupIds',
        'campaignIdFilter'  => 'addCampaignIds',
        'stateFilter'       => 'addStates',
        'matchTypeFilter'   => 'addMatchTypes',
        'keywordText'       => 'setKeywordText',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [
        'adGroupIdFilter',
        'campaignIdFilter',
        'stateFilter',
        'matchTypeFilter',
    ];

    /**
     * @param int $startIndex
     *
     * @return NegativeKeywordParams
     */
    public function setStartIndex(int $startIndex): self
    {
        $this->params['startIndex'] = $startIndex;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return NegativeKeywordParams
     */
    public function addToStartIndex(int $count): self
    {
        $this->params['startIndex'] += $count;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return NegativeKeywordParams
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
        return (int) $this->params['count'];
    }

    /**
     * @param State[] $states
     *
     * @return NegativeKeywordParams
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
     * @return NegativeKeywordParams
     */
    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }

    /**
     * @param int[] $campaigns
     *
     * @return NegativeKeywordParams
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
     * @return NegativeKeywordParams
     */
    public function addCampaignId(int $campaignId): self
    {
        $this->params['campaignIdFilter'][] = $campaignId;

        return $this;
    }

    /**
     * @param int[] $adGroupIds
     *
     * @return NegativeKeywordParams
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
     * @return NegativeKeywordParams
     */
    public function addAdGroupId(int $adGroupId): self
    {
        $this->params['adGroupIdFilter'][] = $adGroupId;

        return $this;
    }

    /**
     * @param NegativeKeywordMatchType[] $matchTypes
     *
     * @return NegativeKeywordParams
     */
    public function addMatchTypes(array $matchTypes): NegativeKeywordParams
    {
        $matchTypes = (function (NegativeKeywordMatchType ...$matchTypes) {
            return $matchTypes;
        })(...$matchTypes);

        foreach ($matchTypes as $matchType) {
            $this->addMatchType($matchType);
        }

        return $this;
    }

    /**
     * @param NegativeKeywordMatchType $matchType
     *
     * @return NegativeKeywordParams
     */
    public function addMatchType(NegativeKeywordMatchType $matchType): NegativeKeywordParams
    {
        $this->params['matchTypeFilter'][] = $matchType;

        return $this;
    }

    /**
     * @param string $keywordText
     *
     * @return NegativeKeywordParams
     */
    public function setKeywordText(string $keywordText): NegativeKeywordParams
    {
        $this->params['keywordText'] = $keywordText;

        return $this;
    }
}
