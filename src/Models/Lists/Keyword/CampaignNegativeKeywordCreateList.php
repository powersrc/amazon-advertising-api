<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword;

use PowerSrc\AmazonAdvertisingApi\Models\CampaignNegativeKeyword;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class CampaignNegativeKeywordCreateList extends CampaignNegativeKeywordList
{
    public function toArray(): array
    {
        $props = [
            'campaignId'  => null,
            'keywordText' => null,
            'matchType'   => null,
            'state'       => null,
        ];

        return array_map(function (CampaignNegativeKeyword $keyword) use ($props) {
            return Obj::transpose((object) $props, $keyword, ...array_keys($props));
        }, $this->itemList);
    }
}
