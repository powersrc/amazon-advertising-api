<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword;

use PowerSrc\AmazonAdvertisingApi\Models\Keyword;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class KeywordUpdateList extends KeywordList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'state' => null,
            'bid'   => null,
        ];

        return \array_map(function (Keyword $keyword) use ($props) {
            /*
             * Unset properties that are not set on the Keyword object.
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
