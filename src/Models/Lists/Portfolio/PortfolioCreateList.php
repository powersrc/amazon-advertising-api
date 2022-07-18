<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio;

use PowerSrc\AmazonAdvertisingApi\Models\Portfolio;
use PowerSrc\AmazonAdvertisingApi\Models\PortfolioBudget;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class PortfolioCreateList extends PortfolioList
{
    public function toArray(): array
    {
        $props = [
            'name'   => null,
            'state'  => null,
            'budget' => null,
        ];

        /*
         * Optional properties for creating portfolios.
         */
        $optional = [
            'budget',
        ];

        return \array_map(function (Portfolio $portfolio) use ($props, $optional) {
            $portfolioClone = clone $portfolio;

            /*
             * Unset properties that are not set on the Portfolio object.
             */
            foreach ($optional as $prop) {
                if ( ! isset($portfolioClone->{$prop})) {
                    unset($props[$prop]);
                }
            }

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
         * Optional properties for creating portfolio budgets.
         */
        $optional = [
            'amount',
            'endDate',
        ];

        /*
         * Unset properties that are not set on the PortfolioBudget object.
         */
        foreach ($optional as $prop) {
            if ( ! isset($budget->{$prop})) {
                unset($props[$prop]);
            }
        }

        return Obj::transpose((object) $props, $budget, ...\array_keys($props));
    }
}
