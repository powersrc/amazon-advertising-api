<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\AdGroup;

use PowerSrc\AmazonAdvertisingApi\Models\AdGroup;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class AdGroupCreateList extends AdGroupList
{
    public function toArray(): array
    {
        $props = [
            'name'       => null,
            'campaignId' => null,
            'defaultBid' => null,
            'state'      => null,
        ];

        return \array_map(function (AdGroup $adGroup) use ($props) {
            return Obj::transpose((object) $props, $adGroup, ...\array_keys($props));
        }, $this->itemList);
    }
}
