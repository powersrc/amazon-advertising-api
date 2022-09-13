<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio;

use PowerSrc\AmazonAdvertisingApi\Models\Portfolio;
use PowerSrc\AmazonAdvertisingApi\Models\PortfolioBudget;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class PortfolioUpdateList extends PortfolioList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'name'   => null,
            'state'  => null,
            'budget' => null,
        ];

        return \array_map(function (Portfolio $portfolio) use ($props) {
            $portfolioClone = clone $portfolio;

            /*
             * Unset properties that are not set on the Portfolio object.
             */
            foreach ($props as $key => $value) {
                if ( ! isset($portfolioClone->{$key})) {
                    unset($props[$key]);
                }
            }
            $props['portfolioId'] = null;

            if (isset($props['budget']) && isset($portfolioClone->budget)) {
                $portfolioClone->budget = $this->transposeBudget($portfolioClone->budget);
            }

            return Obj::transpose((object) $props, $portfolioClone, ...\array_keys($props));
        }, $this->itemList);
    }

    protected function transposeBudget(PortfolioBudget $budget)
    {
        $props = [
            'amount'    => null,
            'policy'    => null,
            'startDate' => null,
            'endDate'   => null,
        ];

        /*
         * Unset properties that are not set on the PortfolioBudget object.
         */
        foreach ($props as $key => $value) {
            if ( ! isset($budget->{$key})) {
                unset($props[$key]);
            }
        }

        return Obj::transpose((object) $props, $budget, ...\array_keys($props));
    }
}
