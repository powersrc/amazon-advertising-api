<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword;

use PowerSrc\AmazonAdvertisingApi\Models\NegativeKeyword;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class NegativeKeywordCreateList extends NegativeKeywordList
{
    public function toArray(): array
    {
        $props = [
            'campaignId'  => null,
            'adGroupId'   => null,
            'keywordText' => null,
            'matchType'   => null,
            'state'       => null,
        ];

        return array_map(function (NegativeKeyword $keyword) use ($props) {
            return Obj::transpose((object) $props, $keyword, ...array_keys($props));
        }, $this->itemList);
    }
}
