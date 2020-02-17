<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign;

use PowerSrc\AmazonAdvertisingApi\Models\Campaign;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class CampaignCreateList extends CampaignList
{
    /**
     * @var int
     */
    protected $portfolioId;

    public function toArray(): array
    {
        $props = [
            'portfolioId'   => null,
            'campaignType'  => null,
            'name'          => null,
            'targetingType' => null,
            'state'         => null,
            'dailyBudget'   => null,
            'startDate'     => null,
            'endDate'       => null,
            'bidding'       => null,
        ];

        /*
         * Optional properties for creating campaigns.
         */
        $optional = [
            'endDate',
            'bidding',
        ];

        $data = array_map(function (Campaign $campaign) use ($props, $optional) {
            /*
             * Unset properties that are not set on the Campaign object.
             */
            foreach ($optional as $prop) {
                if ( ! isset($campaign->{$prop})) {
                    unset($props[$prop]);
                }
            }

            return Obj::transpose((object) $props, $campaign, ...array_keys($props));
        }, $this->itemList);

        if (isset($this->portfolioId)) {
            $data['portfolioId'] = $this->portfolioId;
        }

        return $data;
    }

    public function setPortfolioId(int $portfolioId): CampaignCreateList
    {
        $this->portfolioId = $portfolioId;

        return $this;
    }
}
