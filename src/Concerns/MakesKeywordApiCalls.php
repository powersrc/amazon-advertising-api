<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Models\BidRecommendationsResponse;
use PowerSrc\AmazonAdvertisingApi\Models\CampaignNegativeKeyword;
use PowerSrc\AmazonAdvertisingApi\Models\CampaignNegativeKeywordEx;
use PowerSrc\AmazonAdvertisingApi\Models\CampaignNegativeKeywordResponse;
use PowerSrc\AmazonAdvertisingApi\Models\Keyword;
use PowerSrc\AmazonAdvertisingApi\Models\KeywordBidRecommendation;
use PowerSrc\AmazonAdvertisingApi\Models\KeywordEx;
use PowerSrc\AmazonAdvertisingApi\Models\KeywordResponse;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\CampaignNegativeKeywordCreateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\CampaignNegativeKeywordExList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\CampaignNegativeKeywordList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\CampaignNegativeKeywordResponseList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\CampaignNegativeKeywordUpdateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\KeywordCreateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\KeywordExList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\KeywordList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\KeywordResponseList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\KeywordUpdateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\NegativeKeywordCreateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\NegativeKeywordExList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\NegativeKeywordList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\NegativeKeywordResponseList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Keyword\NegativeKeywordUpdateList;
use PowerSrc\AmazonAdvertisingApi\Models\NegativeKeyword;
use PowerSrc\AmazonAdvertisingApi\Models\NegativeKeywordEx;
use PowerSrc\AmazonAdvertisingApi\Models\NegativeKeywordResponse;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\CampaignNegativeKeywordParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\KeywordBidRecommendationParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\KeywordParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\NegativeKeywordParams;
use ReflectionException;

trait MakesKeywordApiCalls
{
    /**
     * Retrieves a keyword by ID.
     *
     * Note that this call returns the minimal set of keyword fields,
     * but is more efficient than getBiddableKeywordEx.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return Keyword
     */
    public function getBiddableKeyword(int $keywordId): Keyword
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/keywords/' . $keywordId));

        return new Keyword($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a keyword and its extended fields by ID.
     *
     * Note that this call returns the complete set of keyword fields
     * (including serving status and other read-only fields),
     * but is less efficient than getBiddableKeyword.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return KeywordEx
     */
    public function getBiddableKeywordEx(int $keywordId): KeywordEx
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/keywords/extended/' . $keywordId));

        return new KeywordEx($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Creates one or more keywords for Sponsored Products or Sponsored Brands.
     * Successfully created keywords will be assigned a unique keywordId.
     *
     * @param KeywordCreateList $keywordCreateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return KeywordResponseList
     */
    public function createBiddableKeywords(KeywordCreateList $keywordCreateList): KeywordResponseList
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/keywords'), $keywordCreateList);

        return new KeywordResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Updates one or more keywords for Sponsored Products based on unique keywordId.
     *
     * @param KeywordUpdateList $keywordUpdateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return KeywordResponseList
     */
    public function updateBiddableKeywords(KeywordUpdateList $keywordUpdateList): KeywordResponseList
    {
        $response = $this->operation(HttpMethod::PUT(), $this->getApiUrl('sp/keywords'), $keywordUpdateList);

        return new KeywordResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Sets the keyword status to archived.
     *
     * This same operation can be performed via an update, but is included for completeness.
     * Archived entities cannot be made active again.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return KeywordResponse
     */
    public function archiveBiddableKeyword(int $keywordId): KeywordResponse
    {
        $response = $this->operation(HttpMethod::DELETE(), $this->getApiUrl('sp/keywords/' . $keywordId));

        return new KeywordResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of keywords satisfying optional criteria.
     *
     * Note that this call returns the minimal set of keyword fields,
     * but is more efficient than listBiddableKeywordsEx.
     *
     * @param KeywordParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return KeywordList
     */
    public function listBiddableKeywords(KeywordParams $params): KeywordList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/keywords', $params));

        return new KeywordList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of keywords satisfying optional criteria.
     *
     * Note that this call returns the complete set of keyword fields
     * (including serving status and other read-only fields),
     * but is less efficient than listBiddableKeywords.
     *
     * @param KeywordParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return KeywordExList
     */
    public function listBiddableKeywordsEx(KeywordParams $params): KeywordExList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/keywords/extended', $params));

        return new KeywordExList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a negative keyword by ID.
     *
     * Note that this call returns the minimal set of keyword fields,
     * but is more efficient than getNegativeKeywordEx.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return NegativeKeyword
     */
    public function getNegativeKeyword(int $keywordId): NegativeKeyword
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/negativeKeywords/' . $keywordId));

        return new NegativeKeyword($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a negative keyword and its extended fields by ID.
     *
     * Note that this call returns the complete set of keyword fields
     * (including serving status and other read-only fields),
     * but is less efficient than getNegativeKeyword.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return NegativeKeywordEx
     */
    public function getNegativeKeywordEx(int $keywordId): NegativeKeywordEx
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/negativeKeywords/extended/' . $keywordId));

        return new NegativeKeywordEx($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Creates one or more negative keywords.
     * Successfully created keywords will be assigned a unique keywordId.
     *
     * @param NegativeKeywordCreateList $keywordCreateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return NegativeKeywordResponseList
     */
    public function createNegativeKeywords(NegativeKeywordCreateList $keywordCreateList): NegativeKeywordResponseList
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/negativeKeywords'), $keywordCreateList);

        return new NegativeKeywordResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Updates one or more negative keywords for Sponsored Products based on unique keywordId.
     *
     * @param NegativeKeywordUpdateList $keywordUpdateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return NegativeKeywordResponseList
     */
    public function updateNegativeKeywords(NegativeKeywordUpdateList $keywordUpdateList): NegativeKeywordResponseList
    {
        $response = $this->operation(HttpMethod::PUT(), $this->getApiUrl('sp/negativeKeywords'), $keywordUpdateList);

        return new NegativeKeywordResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Sets the keyword status to archived.
     *
     * This same operation can be performed via an update, but is included for completeness.
     * Archived entities cannot be made active again.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return NegativeKeywordResponse
     */
    public function archiveNegativeKeyword(int $keywordId): NegativeKeywordResponse
    {
        $response = $this->operation(HttpMethod::DELETE(), $this->getApiUrl('sp/negativeKeywords/' . $keywordId));

        return new NegativeKeywordResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of negative keywords satisfying optional criteria.
     *
     * Note that this call returns the minimal set of keyword fields,
     * but is more efficient than listNegativeKeywordsEx.
     *
     * @param NegativeKeywordParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return NegativeKeywordList
     */
    public function listNegativeKeywords(NegativeKeywordParams $params): NegativeKeywordList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/negativeKeywords', $params));

        return new NegativeKeywordList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of negative keywords satisfying optional criteria.
     *
     * Note that this call returns the complete set of keyword fields
     * (including serving status and other read-only fields),
     * but is less efficient than listNegativeKeywords.
     *
     * @param NegativeKeywordParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return NegativeKeywordExList
     */
    public function listNegativeKeywordsEx(NegativeKeywordParams $params): NegativeKeywordExList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/negativeKeywords/extended', $params));

        return new NegativeKeywordExList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a campaign negative keyword by ID.
     *
     * Note that this call returns the minimal set of keyword fields,
     * but is more efficient than getCampaignNegativeKeywordEx.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return CampaignNegativeKeyword
     */
    public function getCampaignNegativeKeyword(int $keywordId): CampaignNegativeKeyword
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaignNegativeKeywords/' . $keywordId));

        return new CampaignNegativeKeyword($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a campaign negative keyword and its extended fields by ID.
     *
     * Note that this call returns the complete set of keyword fields
     * (including serving status and other read-only fields),
     * but is less efficient than getCampaignNegativeKeyword.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return CampaignNegativeKeywordEx
     */
    public function getCampaignNegativeKeywordEx(int $keywordId): CampaignNegativeKeywordEx
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaignNegativeKeywords/extended/' . $keywordId));

        return new CampaignNegativeKeywordEx($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Creates one or more campaign negative keywords.
     * Successfully created keywords will be assigned a unique keywordId.
     *
     * @param CampaignNegativeKeywordCreateList $keywordCreateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return CampaignNegativeKeywordResponseList
     */
    public function createCampaignNegativeKeywords(CampaignNegativeKeywordCreateList $keywordCreateList): CampaignNegativeKeywordResponseList
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/campaignNegativeKeywords'), $keywordCreateList);

        return new CampaignNegativeKeywordResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Updates one or more campaign negative keywords for Sponsored Products based on unique keywordId.
     *
     * @param CampaignNegativeKeywordUpdateList $keywordUpdateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return CampaignNegativeKeywordResponseList
     */
    public function updateCampaignNegativeKeywords(CampaignNegativeKeywordUpdateList $keywordUpdateList): CampaignNegativeKeywordResponseList
    {
        $response = $this->operation(HttpMethod::PUT(), $this->getApiUrl('sp/campaignNegativeKeywords'), $keywordUpdateList);

        return new CampaignNegativeKeywordResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Deletes the keyword permanently.
     *
     * This same operation can be performed via an update, but is included for completeness.
     * Deleted entities cannot be made active again and attempting to fetch
     * a deleted entity from the api by id will return an error.
     *
     * @param int $keywordId
     *
     * @throws HttpException
     * @throws ReflectionException
     * @throws ClassNotFoundException
     *
     * @return CampaignNegativeKeywordResponse
     */
    public function removeCampaignNegativeKeyword(int $keywordId): CampaignNegativeKeywordResponse
    {
        $response = $this->operation(HttpMethod::DELETE(), $this->getApiUrl('sp/campaignNegativeKeywords/' . $keywordId));

        return new CampaignNegativeKeywordResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of campaign negative keywords satisfying optional criteria.
     *
     * Note that this call returns the minimal set of keyword fields,
     * but is more efficient than listCampaignNegativeKeywordsEx.
     *
     * @param CampaignNegativeKeywordParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return CampaignNegativeKeywordList
     */
    public function listCampaignNegativeKeywords(CampaignNegativeKeywordParams $params): CampaignNegativeKeywordList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaignNegativeKeywords', $params));

        return new CampaignNegativeKeywordList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of campaign negative keywords satisfying optional criteria.
     *
     * Note that this call returns the complete set of keyword fields
     * (including serving status and other read-only fields),
     * but is less efficient than listCampaignNegativeKeywords.
     *
     * @param CampaignNegativeKeywordParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return CampaignNegativeKeywordExList
     */
    public function listCampaignNegativeKeywordsEx(CampaignNegativeKeywordParams $params): CampaignNegativeKeywordExList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaignNegativeKeywords/extended', $params));

        return new CampaignNegativeKeywordExList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieve bid recommendation data for the specified keywordId.
     *
     * @param int $keywordId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return KeywordBidRecommendation
     */
    public function getKeywordBidRecommendations(int $keywordId): KeywordBidRecommendation
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('keywords/' . $keywordId . '/bidRecommendations'));

        return new KeywordBidRecommendation($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param KeywordBidRecommendationParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return BidRecommendationsResponse
     */
    public function createKeywordBidRecommendations(KeywordBidRecommendationParams $params): BidRecommendationsResponse
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('keywords/bidRecommendations'), $params);

        return new BidRecommendationsResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }
}
