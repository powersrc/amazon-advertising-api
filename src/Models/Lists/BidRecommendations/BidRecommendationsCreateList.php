<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\BidRecommendations;

use PowerSrc\AmazonAdvertisingApi\Models\BidRecommendation;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class BidRecommendationsCreateList extends BidRecommendationsList
{
    public function toArray(): array
    {
        $props = [
            'keyword'   => null,
            'matchType' => null,
        ];

        return \array_map(function (BidRecommendation $bidRecommendation) use ($props) {
            return Obj::transpose((object) $props, $bidRecommendation, ...\array_keys($props));
        }, $this->itemList);
    }
}
