<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign;

use PowerSrc\AmazonAdvertisingApi\Models\Campaign;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class CampaignUpdateList extends CampaignList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'name'        => null,
            'portfolioId' => null,
            'state'       => null,
            'dailyBudget' => null,
            'startDate'   => null,
            'endDate'     => null,
            'bidding'     => null,
        ];

        return \array_map(function (Campaign $campaign) use ($props) {
            /*
             * Unset properties that are not set on the Campaign object.
             */
            foreach ($props as $key => $value) {
                if ( ! isset($campaign->{$key})) {
                    unset($props[$key]);
                }
            }
            $props['campaignId'] = null;

            return Obj::transpose((object) $props, $campaign, ...\array_keys($props));
        }, $this->itemList);
    }
}
