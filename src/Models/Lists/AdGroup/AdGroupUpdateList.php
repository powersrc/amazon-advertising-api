<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\AdGroup;

use PowerSrc\AmazonAdvertisingApi\Models\AdGroup;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class AdGroupUpdateList extends AdGroupList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'name'       => null,
            'campaignId' => null,
            'defaultBid' => null,
            'state'      => null,
        ];

        return \array_map(function (AdGroup $adGroup) use ($props) {
            /*
             * Unset properties that are not set on the AdGroup object.
             */
            foreach ($props as $key => $value) {
                if ( ! isset($adGroup->{$key})) {
                    unset($props[$key]);
                }
            }
            $props['adGroupId'] = null;

            return Obj::transpose((object) $props, $adGroup, ...\array_keys($props));
        }, $this->itemList);
    }
}
