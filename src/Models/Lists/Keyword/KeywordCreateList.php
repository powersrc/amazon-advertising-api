<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword;

use PowerSrc\AmazonAdvertisingApi\Models\Keyword;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class KeywordCreateList extends KeywordList
{
    public function toArray(): array
    {
        $props = [
            'campaignId'  => null,
            'adGroupId'   => null,
            'keywordText' => null,
            'matchType'   => null,
            'state'       => null,
            'bid'         => null,
        ];

        /*
         * Optional properties for creating campaigns.
         */
        $optional = [
            'bid',
        ];

        return \array_map(function (Keyword $keyword) use ($props, $optional) {
            /*
             * Unset properties that are not set on the Keyword object.
             */
            foreach ($optional as $prop) {
                if ( ! isset($keyword->{$prop})) {
                    unset($props[$prop]);
                }
            }

            return Obj::transpose((object) $props, $keyword, ...\array_keys($props));
        }, $this->itemList);
    }
}
