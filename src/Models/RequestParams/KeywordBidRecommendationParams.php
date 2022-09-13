<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Models\Lists\BidRecommendations\BidRecommendationsCreateList;

class KeywordBidRecommendationParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'adGroupId' => null,
        'keywords'  => null,
    ];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [
        'adGroupId' => 'setAdGroupId',
        'keywords'  => 'setKeywords',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [];

    public function setAdGroupId(int $adGroupId): self
    {
        $this->params['adGroupId'] = $adGroupId;

        return $this;
    }

    public function setKeywords(BidRecommendationsCreateList $keywordBidRecommendationCreateList): self
    {
        $this->params['keywords'] = $keywordBidRecommendationCreateList;

        return $this;
    }
}
