<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd\ProductAdCreateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd\ProductAdExList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd\ProductAdList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd\ProductAdResponseList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\ProductAd\ProductAdUpdateList;
use PowerSrc\AmazonAdvertisingApi\Models\ProductAd;
use PowerSrc\AmazonAdvertisingApi\Models\ProductAdEx;
use PowerSrc\AmazonAdvertisingApi\Models\ProductAdResponse;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\ProductAdParams;
use ReflectionException;

trait MakesProductAdApiCalls
{
    /**
     * @param int $adId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return ProductAd
     */
    public function getProductAd(int $adId): ProductAd
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/productAds/' . $adId));

        return new ProductAd($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param int $adId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return ProductAdEx
     */
    public function getProductAdEx(int $adId): ProductAdEx
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/productAds/extended/' . $adId));

        return new ProductAdEx($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param ProductAdCreateList $adCreateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return ProductAdResponseList
     */
    public function createProductAds(ProductAdCreateList $adCreateList): ProductAdResponseList
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('sp/productAds'), $adCreateList);

        return new ProductAdResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param ProductAdUpdateList $adUpdateList
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return ProductAdResponseList
     */
    public function updateProductAds(ProductAdUpdateList $adUpdateList): ProductAdResponseList
    {
        $response = $this->operation(HttpMethod::PUT(), $this->getApiUrl('sp/productAds'), $adUpdateList);

        return new ProductAdResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param int $adId
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return ProductAdResponse
     */
    public function archiveProductAd(int $adId): ProductAdResponse
    {
        $response = $this->operation(HttpMethod::DELETE(), $this->getApiUrl('sp/productAds/' . $adId));

        return new ProductAdResponse($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param ProductAdParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return ProductAdList
     */
    public function listProductAds(ProductAdParams $params): ProductAdList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/productAds', $params));

        return new ProductAdList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @param ProductAdParams $params
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     *
     * @return ProductAdExList
     */
    public function listProductAdsEx(ProductAdParams $params): ProductAdExList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('sp/productAds/extended', $params));

        return new ProductAdExList($this->decodeResponseBody($response, MimeType::JSON()));
    }
}
