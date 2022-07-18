<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class PortfolioParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'portfolioIdFilter'    => [],
        'portfolioNameFilter'  => [],
        'portfolioStateFilter' => [],
    ];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [
        'portfolioIdFilter'    => 'addPortfolioIds',
        'portfolioNameFilter'  => 'addPortfolioNames',
        'portfolioStateFilter' => 'addPortfolioStates',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [
        'portfolioIdFilter',
        'portfolioNameFilter',
        'portfolioStateFilter',
    ];

    /**
     * @param int[] $portfolioIds
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

    public function addPortfolioId(int $portfolioId): self
    {
        $this->params['portfolioIdFilter'][] = $portfolioId;

        return $this;
    }

    /**
     * @param string[] $portfolioNames
     */
    public function addPortfolioNames(array $portfolioNames): self
    {
        $portfolioNames = (function (string ...$portfolioNames) {
            return $portfolioNames;
        })(...$portfolioNames);

        foreach ($portfolioNames as $portfolioName) {
            $this->addPortfolioName($portfolioName);
        }

        return $this;
    }

    public function addPortfolioName(string $portfolioName): self
    {
        $this->params['portfolioNameFilter'][] = $portfolioName;

        return $this;
    }

    /**
     * @param State[] $portfolioStates
     */
    public function addPortfolioStates(array $portfolioStates): self
    {
        $portfolioStates = (function (State ...$portfolioStates) {
            return $portfolioStates;
        })(...$portfolioStates);

        foreach ($portfolioStates as $portfolioState) {
            $this->addPortfolioState($portfolioState);
        }

        return $this;
    }

    public function addPortfolioState(State $portfolioState): self
    {
        $this->params['portfolioStateFilter'][] = $portfolioState;

        return $this;
    }
}
