<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

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

    /**
     * @param int $startIndex
     *
     * @return KeywordParams
     */
    public function setStartIndex(int $startIndex): self
    {
        $this->params['startIndex'] = $startIndex;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return KeywordParams
     */
    public function addToStartIndex(int $count): self
    {
        $this->params['startIndex'] += $count;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return KeywordParams
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
     * @return KeywordParams
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
     * @return KeywordParams
     */
    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }

    /**
     * @param int[] $campaigns
     *
     * @return KeywordParams
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
     * @return KeywordParams
     */
    public function addCampaignId(int $campaignId): self
    {
        $this->params['campaignIdFilter'][] = $campaignId;

        return $this;
    }

    /**
     * @param int[] $adGroupIds
     *
     * @return KeywordParams
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
     * @return KeywordParams
     */
    public function addAdGroupId(int $adGroupId): self
    {
        $this->params['adGroupIdFilter'][] = $adGroupId;

        return $this;
    }

    /**
     * @param KeywordMatchType[] $matchTypes
     *
     * @return KeywordParams
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

    /**
     * @param KeywordMatchType $matchType
     *
     * @return KeywordParams
     */
    public function addMatchType(KeywordMatchType $matchType): KeywordParams
    {
        $this->params['matchTypeFilter'][] = $matchType;

        return $this;
    }

    /**
     * @param int[] $keywordIds
     *
     * @return KeywordParams
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

    /**
     * @param int $keywordId
     *
     * @return KeywordParams
     */
    public function addKeywordId(int $keywordId): KeywordParams
    {
        $this->params['keywordIdFilter'][] = $keywordId;

        return $this;
    }

    /**
     * @param string $keywordText
     *
     * @return KeywordParams
     */
    public function setKeywordText(string $keywordText): KeywordParams
    {
        $this->params['keywordText'] = $keywordText;

        return $this;
    }
}
