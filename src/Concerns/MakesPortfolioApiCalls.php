<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use GuzzleHttp\Exception\GuzzleException;
use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio\PortfolioCreateList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio\PortfolioExList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio\PortfolioList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio\PortfolioResponseList;
use PowerSrc\AmazonAdvertisingApi\Models\Lists\Portfolio\PortfolioUpdateList;
use PowerSrc\AmazonAdvertisingApi\Models\Portfolio;
use PowerSrc\AmazonAdvertisingApi\Models\PortfolioEx;
use PowerSrc\AmazonAdvertisingApi\Models\RequestParams\PortfolioParams;
use ReflectionException;

trait MakesPortfolioApiCalls
{
    /**
     * @throws ClassNotFoundException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function listPortfolios(PortfolioParams $params): PortfolioList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('portfolios', $params));

        return new PortfolioList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @throws ClassNotFoundException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function listPortfoliosEx(PortfolioParams $params): PortfolioExList
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('portfolios/extended', $params));

        return new PortfolioExList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function getPortfolio(int $portfolioId): Portfolio
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('portfolios/' . $portfolioId));

        return new Portfolio($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function getPortfolioEx(int $portfolioId): PortfolioEx
    {
        $response = $this->operation(HttpMethod::GET(), $this->getApiUrl('portfolios/extended/' . $portfolioId));

        return new PortfolioEx($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @throws ClassNotFoundException
     * @throws GuzzleException
     * @throws ReflectionException
     */
    public function createPortfolios(PortfolioCreateList $portfolios): PortfolioResponseList
    {
        $response = $this->operation(HttpMethod::POST(), $this->getApiUrl('portfolios'), $portfolios);

        return new PortfolioResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }

    /**
     * @throws ClassNotFoundException
     * @throws ReflectionException
     * @throws GuzzleException
     */
    public function updatePortfolios(PortfolioUpdateList $portfolios): PortfolioResponseList
    {
        $response = $this->operation(HttpMethod::PUT(), $this->getApiUrl('portfolios'), $portfolios);

        return new PortfolioResponseList($this->decodeResponseBody($response, MimeType::JSON()));
    }
}
