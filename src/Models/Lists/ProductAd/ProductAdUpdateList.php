<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd;

use PowerSrc\AmazonAdvertisingApi\Models\ProductAd;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class ProductAdUpdateList extends ProductAdList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'state'      => null,
        ];

        return \array_map(function (ProductAd $productAd) use ($props) {
            /*
             * Unset properties that are not set on the ProductAd object.
             */
            foreach ($props as $key => $value) {
                if ( ! isset($productAd->{$key})) {
                    unset($props[$key]);
                }
            }
            $props['adId'] = null;

            return Obj::transpose((object) $props, $productAd, ...\array_keys($props));
        }, $this->itemList);
    }
}
