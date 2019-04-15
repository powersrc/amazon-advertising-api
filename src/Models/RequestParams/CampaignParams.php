<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Config;
use PowerSrc\AmazonAdvertisingApi\Enums\CampaignType;
use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class CampaignParams extends RequestParams
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
        'portfolioIdFilter' => [],
        'campaignIdFilter'  => [],
        'campaignType'      => null,
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
        'portfolioIdFilter' => 'addPortfolioIds',
        'campaignIdFilter'  => 'addCampaignIds',
        'campaignType'      => 'setCampaignType',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [
        'stateFilter',
        'campaignIdFilter',
        'portfolioIdFilter',
    ];

    /**
     * @param int $startIndex
     *
     * @return CampaignParams
     */
    public function setStartIndex(int $startIndex): self
    {
        $this->params['startIndex'] = $startIndex;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return CampaignParams
     */
    public function addToStartIndex(int $count): self
    {
        $this->params['startIndex'] += $count;

        return $this;
    }

    /**
     * @param int $count
     *
     * @return CampaignParams
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
     * @param CampaignType $type
     *
     * @return CampaignParams
     */
    public function setCampaignType(CampaignType $type): self
    {
        $this->params['campaignType'] = $type;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return CampaignParams
     */
    public function setName(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    /**
     * @param State[] $states
     *
     * @return CampaignParams
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
     * @return CampaignParams
     */
    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }

    /**
     * @param int[] $campaigns
     *
     * @return CampaignParams
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
     * @return CampaignParams
     */
    public function addCampaignId(int $campaignId): self
    {
        $this->params['campaignIdFilter'][] = $campaignId;

        return $this;
    }

    /**
     * @param int[] $portfolioIds
     *
     * @return CampaignParams
     */
    public function addPortfolioIds(array $portfolioIds): self
    {
        $portfolioIds = (function (int ...$portfolioIds) {
            return $portfolioIds;
        })(...$portfolioIds);

        foreach ($portfolioIds as $portfolioId) {
            $this->addPortfolioId($portfolioId);
        }

        return $this;
    }

    /**
     * @param int $portfolioId
     *
     * @return CampaignParams
     */
    public function addPortfolioId(int $portfolioId): self
    {
        $this->params['portfolioIdFilter'][] = $portfolioId;

        return $this;
    }
}
