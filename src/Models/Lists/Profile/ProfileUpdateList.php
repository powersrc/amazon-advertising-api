<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists\Profile;

use PowerSrc\AmazonAdvertisingApi\Models\Profile;
use PowerSrc\AmazonAdvertisingApi\Support\Obj;

class ProfileUpdateList extends ProfileList
{
    public function toArray(): array
    {
        /*
         * Mutable properties.
         */
        $props = [
            'dailyBudget' => null,
        ];

        return array_map(function (Profile $profile) use ($props) {
            /*
             * Unset properties that are not set on the Profile object.
             */
            foreach ($props as $key => $value) {
                if ( ! isset($profile->{$key})) {
                    unset($props[$key]);
                }
            }
            $props['profileId'] = null;

            return Obj::transpose((object) $props, $profile, ...array_keys($props));
        }, $this->itemList);
    }
}
