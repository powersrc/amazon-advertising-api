<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Enums\SnapshotRecordType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\AdGroup\AdGroupList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign\CampaignList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\CampaignNegativeKeywordList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\KeywordList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\NegativeKeywordList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio\PortfolioList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd\ProductAdList;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\SnapshotParams;
use PowerSrc\AmazonAdvertisingApi\Models\SnapshotResponse;
use ReflectionException;

trait MakesSnapshotCalls
{

    /**
     * @param SnapshotRecordType $type
     * @param SnapshotParams     $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestSnapshot(SnapshotRecordType $type, SnapshotParams $params): SnapshotResponse
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/' . $type->getValue() . '/snapshot'), $params);

        return new SnapshotResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param string $snapshotId
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function getSnapshot(string $snapshotId): SnapshotResponse
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('snapshots/' . $snapshotId));

        return new SnapshotResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Downloads the Snapshot file at location provided and returns
     * the decoded payload. The return type can be any type other than a resource,
     * but should be array or stdClass.
     *
     * @param string $location
     *
     * @throws HttpException
     *
     * @return mixed
     */
    public function downloadSnapshot(string $location)
    {
        $response = $this->operation(HttpMethod::GET(), $location);

        return $this->decodeResponseBody($response, MimeType::JSON());
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestPortfoliosSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::PORTFOLIOS(), $params);
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestCampaignsSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::CAMPAIGNS(), $params);
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestAdGroupsSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::AD_GROUPS(), $params);
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestProductAdsSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::PRODUCT_ADS(), $params);
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestKeywordsSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::KEYWORDS(), $params);
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestNegativeKeywordsSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::NEGATIVE_KEYWORDS(), $params);
    }

    /**
     * @param SnapshotParams $params
     *
     * @throws ReflectionException
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return SnapshotResponse
     */
    public function requestCampaignNegativeKeywordsSnapshot(SnapshotParams $params): SnapshotResponse
    {
        return $this->requestSnapshot(SnapshotRecordType::CAMPAIGN_NEGATIVE_KEYWORDS(), $params);
    }

    /**
     * Downloads a Portfolios Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return PortfolioList
     */
    public function downloadPortfoliosSnapshot(string $location): PortfolioList
    {
        return new PortfolioList($this->downloadSnapshot($location));
    }

    /**
     * Downloads a Campaigns Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return CampaignList
     */
    public function downloadCampaignsSnapshot(string $location): CampaignList
    {
        return new CampaignList($this->downloadSnapshot($location));
    }

    /**
     * Downloads an AdGroups Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return AdGroupList
     */
    public function downloadAdGroupsSnapshot(string $location): AdGroupList
    {
        return new AdGroupList($this->downloadSnapshot($location));
    }

    /**
     * Downloads a ProductAds Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return ProductAdList
     */
    public function downloadProductAdsSnapshot(string $location): ProductAdList
    {
        return new ProductAdList($this->downloadSnapshot($location));
    }

    /**
     * Downloads a Keywords Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return KeywordList
     */
    public function downloadKeywordsSnapshot(string $location): KeywordList
    {
        return new KeywordList($this->downloadSnapshot($location));
    }

    /**
     * Downloads a NegativeKeywords Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return NegativeKeywordList
     */
    public function downloadNegativeKeywordsSnapshot(string $location): NegativeKeywordList
    {
        return new NegativeKeywordList($this->downloadSnapshot($location));
    }

    /**
     * Downloads a CampaignNegativeKeyword Snapshot file from location provided.
     *
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return CampaignNegativeKeywordList
     */
    public function downloadCampaignNegativeKeywordsSnapshot(string $location): CampaignNegativeKeywordList
    {
        return new CampaignNegativeKeywordList($this->downloadSnapshot($location));
    }
}
