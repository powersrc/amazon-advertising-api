<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword;

use PowerSrc\AmazonAdvertisingApi\Models\CampaignNegativeKeyword;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class CampaignNegativeKeywordUpdateList extends CampaignNegativeKeywordList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'state' => null,
        ];

        return \array_map(function (CampaignNegativeKeyword $keyword) use ($props) {
            /*
             * Unset properties that are not set on the CampaignNegativeKeyword object.
             */
            foreach ($props as $key => $value) {
                if ( ! isset($keyword->{$key})) {
                    unset($props[$key]);
                }
            }
            $props['keywordId'] = null;

            return Obj::transpose((object) $props, $keyword, ...\array_keys($props));
        }, $this->itemList);
    }
}
