<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd;

use PowerSrc\AmazonAdvertisingApi\Models\ProductAd;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class ProductAdCreateList extends ProductAdList
{
    public function toArray(): array
    {
        $props = [
            'campaignId' => null,
            'adGroupId'  => null,
            'sku'        => null,
            'asin'       => null,
            'state'      => null,
        ];

        /*
         * Optional properties for creating product ads.
         *
         * One of sku or asin must be provided.
         */
        $optional = [
            'sku',
            'asin',
        ];

        return array_map(function (ProductAd $productAd) use ($props, $optional) {
            /*
             * Unset properties that are not set on the ProductAd object.
             */
            foreach ($optional as $prop) {
                if ( ! isset($productAd->{$prop})) {
                    unset($props[$prop]);
                }
            }

            return Obj::transpose((object) $props, $productAd, ...array_keys($props));
        }, $this->itemList);
    }
}
