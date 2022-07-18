<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Config;
use PowerSrc\AmazonAdvertisingApi\Enums\KeywordMatchType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class KeywordParams extends RequestParams
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
        'keywordIdFilter'   => [],
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
        'keywordIdFilter'   => 'addKeywordIds',
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
        'keywordIdFilter',
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
     * @param KeywordMatchType[] $matchTypes
     */
    public function addMatchTypes(array $matchTypes): KeywordParams
    {
        $matchTypes = (function (KeywordMatchType ...$matchTypes) {
            return $matchTypes;
        })(...$matchTypes);

        foreach ($matchTypes as $matchType) {
            $this->addMatchType($matchType);
        }

        return $this;
    }

    public function addMatchType(KeywordMatchType $matchType): KeywordParams
    {
        $this->params['matchTypeFilter'][] = $matchType;

        return $this;
    }

    /**
     * @param int[] $keywordIds
     */
    public function addKeywordIds(array $keywordIds): KeywordParams
    {
        $keywordIds = (function (int ...$keywordIds) {
            return $keywordIds;
        })(...$keywordIds);

        foreach ($keywordIds as $keywordId) {
            $this->addKeywordId($keywordId);
        }

        return $this;
    }

    public function addKeywordId(int $keywordId): KeywordParams
    {
        $this->params['keywordIdFilter'][] = $keywordId;

        return $this;
    }

    public function setKeywordText(string $keywordText): KeywordParams
    {
        $this->params['keywordText'] = $keywordText;

        return $this;
    }
}
