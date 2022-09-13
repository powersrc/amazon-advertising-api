<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Config;
use PowerSrc\AmazonAdvertisingApi\Enums\NegativeKeywordMatchType;

final class CampaignNegativeKeywordParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'startIndex'        => null,
        'count'             => null,
        'keywordText'       => null,
        'matchTypeFilter'   => [],
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
        'keywordText'       => 'setKeywordText',
        'matchTypeFilter'   => 'addMatchTypes',
        'campaignIdFilter'  => 'addCampaignIds',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [
        'matchTypeFilter',
        'campaignIdFilter',
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
     * @param NegativeKeywordMatchType[] $matchTypes
     */
    public function addMatchTypes(array $matchTypes): CampaignNegativeKeywordParams
    {
        $matchTypes = (function (NegativeKeywordMatchType ...$matchTypes) {
            return $matchTypes;
        })(...$matchTypes);

        foreach ($matchTypes as $matchType) {
            $this->addMatchType($matchType);
        }

        return $this;
    }

    public function addMatchType(NegativeKeywordMatchType $matchType): CampaignNegativeKeywordParams
    {
        $this->params['matchTypeFilter'][] = $matchType;

        return $this;
    }

    public function setKeywordText(string $keywordText): CampaignNegativeKeywordParams
    {
        $this->params['keywordText'] = $keywordText;

        return $this;
    }
}
