<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Enums\ReportRecordType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ReportGZDecodeError;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\AdGroupReportList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\AsinReportList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\CampaignReportList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\KeywordReportList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\ProductAdReportList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Report\TargetReportList;
use PowerSrc\AmazonAdvertisingApi\Models\ReportResponse;
use PowerSrc\AmazonAdvertisingApi\Models\Reports\CampaignReport;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\AdGroupReportParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\AsinReportParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\CampaignReportParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\KeywordReportParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\ProductAdReportParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\ReportParams;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\TargetReportParams;
use PowerSrc\AmazonAdvertisingApi\Support\CastType;
use ReflectionException;

trait MakesReportCalls
{
    /**
     * @param ReportRecordType $type
     * @param ReportParams     $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestReport(ReportRecordType $type, ReportParams $params): ReportResponse
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/' . $type->getValue() . '/report'), $params);

        return new ReportResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param string $reportId
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function getReport(string $reportId)
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('reports/' . $reportId));

        return new ReportResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * Downloads the report file at location provided and returns
     * the decoded payload.
     *
     * @param string $location
     *
     * @throws ReportGZDecodeError
     * @throws HttpException
     *
     * @return mixed
     */
    public function downloadReport(string $location)
    {
        $response = $this->operation(HttpMethod::GET(), $location);

        return $this->decodeReport($response, $location);
    }

    /**
     * @param CampaignReportParams $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestCampaignsReport(CampaignReportParams $params)
    {
        return $this->requestReport(ReportRecordType::CAMPAIGNS(), $params);
    }

    /**
     * @param AdGroupReportParams $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestAdGroupsReport(AdGroupReportParams $params)
    {
        return $this->requestReport(ReportRecordType::AD_GROUPS(), $params);
    }

    /**
     * @param ProductAdReportParams $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestProductAdsReport(ProductAdReportParams $params)
    {
        return $this->requestReport(ReportRecordType::PRODUCT_ADS(), $params);
    }

    /**
     * @param KeywordReportParams $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestKeywordsReport(KeywordReportParams $params)
    {
        return $this->requestReport(ReportRecordType::KEYWORDS(), $params);
    }

    /**
     * @param TargetReportParams $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestTargetsReport(TargetReportParams $params)
    {
        return $this->requestReport(ReportRecordType::TARGETS(), $params);
    }

    /**
     * @param AsinReportParams $params
     *
     * @throws ClassNotFoundException
     * @throws ReflectionException
     *
     * @return ReportResponse
     */
    public function requestAsinsReport(AsinReportParams $params)
    {
        return $this->requestReport(ReportRecordType::ASINS(), $params);
    }

    /**
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws ReportGZDecodeError
     *
     * @return CampaignReportList
     */
    public function downloadCampaignsReport(string $location): CampaignReportList
    {
        return new CampaignReportList($this->downloadReport($location));
    }

    /**
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws ReportGZDecodeError
     *
     * @return AdGroupReportList
     */
    public function downloadAdGroupsReport(string $location): AdGroupReportList
    {
        return new AdGroupReportList($this->downloadReport($location));
    }

    /**
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws ReportGZDecodeError
     *
     * @return AsinReportList
     */
    public function downloadAsinsReport(string $location): AsinReportList
    {
        return new AsinReportList($this->downloadReport($location));
    }

    /**
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws ReportGZDecodeError
     *
     * @return KeywordReportList
     */
    public function downloadKeywordssReport(string $location): KeywordReportList
    {
        return new KeywordReportList($this->downloadReport($location));
    }

    /**
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws ReportGZDecodeError
     *
     * @return ProductAdReportList
     */
    public function downloadProductAdsReport(string $location): ProductAdReportList
    {
        return new ProductAdReportList($this->downloadReport($location));
    }

    /**
     * @param string $location
     *
     * @throws ClassNotFoundException
     * @throws ReportGZDecodeError
     *
     * @return TargetReportList
     */
    public function downloadTargetsReport(string $location): TargetReportList
    {
        return new TargetReportList($this->downloadReport($location));
    }
}
