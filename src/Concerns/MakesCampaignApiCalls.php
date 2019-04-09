<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Models\Campaign;
use PowerSrc\AmazonAdvertisingApi\Models\CampaignEx;
use PowerSrc\AmazonAdvertisingApi\Models\CampaignResponse;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign\CampaignCreateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign\CampaignExList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign\CampaignList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign\CampaignResponseList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Campaign\CampaignUpdateList;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\CampaignParams;
use ReflectionException;

trait MakesCampaignApiCalls
{
    /**
     * Retrieves a campaign by campaignId. Note that this call returns the minimal
     * set of campaign fields, but is more efficient than getCampaignEx.
     *
     * @param int $campaignId
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return Campaign
     */
    public function getCampaign(int $campaignId): Campaign
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaigns/' . $campaignId));

        return new Campaign($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a campaign and its extended fields by campaignId.
     *
     * Note that this call returns the complete set of campaign fields
     * (including serving status and other read-only fields),
     * but is less efficient than getCampaign.
     *
     * @param int $campaignId
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return CampaignEx
     */
    public function getCampaignEx(int $campaignId): CampaignEx
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaigns/extended/' . $campaignId));

        return new CampaignEx($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Creates one or more campaigns. Successfully created campaigns
     * will be assigned a unique campaignId.
     *
     * @param CampaignCreateList $campaignList
     *
     * @throws ClassNotFoundException
     *
     * @return CampaignResponseList
     */
    public function createCampaigns(CampaignCreateList $campaignList): CampaignResponseList
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/campaigns'), $campaignList);

        return new CampaignResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Updates one or more campaigns. A list of up to 100 updates
     * containing campaignId, and the mutable fields to be modified.
     *
     * @param CampaignUpdateList $campaignList
     *
     * @throws ClassNotFoundException
     *
     * @return CampaignResponseList
     */
    public function updateCampaigns(CampaignUpdateList $campaignList): CampaignResponseList
    {
        $response = $this->operation(HttpMethod::PUT(), $this->getApiUrl('sp/campaigns'), $campaignList);

        return new CampaignResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Sets the campaign status to archived. Archived entities cannot be made active again.
     *
     * @param int $campaignId
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return CampaignResponse
     */
    public function archiveCampaign(int $campaignId): CampaignResponse
    {
        $response = $this->operation(HttpMethod::DELETE(), $this->getApiUrl('sp/campaigns/' . $campaignId));

        return new CampaignResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of Sponsored Products campaigns satisfying optional filtering criteria.
     *
     * @param CampaignParams $params
     *
     * @throws ClassNotFoundException
     *
     * @return CampaignList
     */
    public function listCampaigns(CampaignParams $params): CampaignList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaigns', $params));

        return new CampaignList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Retrieves a list of Sponsored Products campaigns with extended fields satisfying optional filtering criteria.
     *
     * @param CampaignParams $params
     *
     * @throws ClassNotFoundException
     *
     * @return CampaignExList
     */
    public function listCampaignsEx(CampaignParams $params): CampaignExList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/campaigns/extended', $params));

        return new CampaignExList($this->decodeResponseBody($response, MimeType::JSON()));
    }
}
