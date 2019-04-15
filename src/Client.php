<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use function gzdecode;
use function http_build_query;
use InvalidArgumentException;
use JsonSerializable;
use PowerSrc\AmazonAdvertisingApi\Concerns\HandlesApiErrors;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesAdGroupApiCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesCampaignApiCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesKeywordApiCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesPortfolioApiCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesProductAdApiCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesProfileApiCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesReportCalls;
use PowerSrc\AmazonAdvertisingApi\Concerns\MakesSnapshotCalls;
use PowerSrc\AmazonAdvertisingApi\Contracts\Arrayable;
use PowerSrc\AmazonAdvertisingApi\Contracts\HttpRequestAuth;
use PowerSrc\AmazonAdvertisingApi\Contracts\RequestThrottle;
use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ReportGZDecodeError;
use PowerSrc\AmazonAdvertisingApi\Support\CastType;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use ReflectionException;
use function usleep;

class Client implements LoggerAwareInterface
{
    use HandlesApiErrors,
        MakesAdGroupApiCalls,
        MakesCampaignApiCalls,
        MakesKeywordApiCalls,
        MakesPortfolioApiCalls,
        MakesProductAdApiCalls,
        MakesProfileApiCalls,
        MakesSnapshotCalls,
        MakesReportCalls;

    /**
     * @var HttpRequestAuth
     */
    protected $requestAuth;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @var RequestThrottle
     */
    protected $throttleManager;

    /**
     * @var string
     */
    protected $apiEndpoint;

    /**
     * @var int
     */
    protected $profileId;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $httpOptions;

    /**
     * Amazon request identifier of the last request.
     *
     * @var string
     */
    protected $lastRequestId;

    public function __construct(Config $config, HttpClientInterface $httpClient, ?int $profileId = null)
    {
        $this->config          = $config;
        $this->throttleManager = $config->getRequestThrottle();
        $this->requestAuth     = $config->getHttpRequestAuth();
        $this->httpClient      = $httpClient;
        $this->profileId       = $profileId;

        $this->headers = [
            'Amazon-Advertising-API-ClientId' => $config->getClientId(),
            'User-Agent'                      => $config->getUserAgent(),
            'Accept'                          => MimeType::JSON,
            'Content-Type'                    => MimeType::JSON,
        ];

        if ($config->shouldUseSandbox()) {
            $this->headers['BIDDING_CONTROLS_ON'] = 'yes';
        }

        $this->httpOptions = [
            RequestOptions::HTTP_ERRORS     => false,
            RequestOptions::TIMEOUT         => $config->getTimeout(),
            RequestOptions::CONNECT_TIMEOUT => $config->getConnectTimeout(),
        ];

        $this->apiEndpoint = $config->getApiEndpoint();
    }

    /**
     * @param Config              $config
     * @param HttpClientInterface $httpClient
     * @param string|null         $profileId
     *
     * @return Client
     */
    public static function with(Config $config, HttpClientInterface $httpClient, ?string $profileId = null): Client
    {
        return new static($config, $httpClient, $profileId);
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return void
     */
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * @param int $profileId
     *
     * @return void
     */
    public function setProfileId(int $profileId): void
    {
        $this->profileId = $profileId;
    }

    /**
     * Returns the Amazon request identifier for the previous API call.
     *
     * @return string|null
     */
    public function getLastRequestId(): ?string
    {
        return $this->lastRequestId;
    }

    /**
     * Helper function to log data within the Client.
     *
     * @param string $message
     * @param array  $context
     */
    protected function logMessage(string $message, array $context = [])
    {
        if ($this->logger) {
            $this->logger->debug($message, $context);
        }
    }

    /**
     * Return the API url to call with request params added.
     *
     * @param string         $fragment
     * @param Arrayable|null $params
     *
     * @return string
     */
    protected function getApiUrl(string $fragment = '', ?Arrayable $params = null): string
    {
        $url = $this->apiEndpoint . $fragment;

        return $params instanceof Arrayable ? $url . '?' . http_build_query($params->toArray()) : $url;
    }

    /**
     * @param HttpMethod            $method
     * @param string                $url
     * @param JsonSerializable|null $body
     * @param bool                  $isDownload
     *
     * @throws ClassNotFoundException
     * @throws GuzzleException
     * @throws InvalidArgumentException
     * @throws ReflectionException
     *
     * @return ResponseInterface
     */
    protected function operation(HttpMethod $method, string $url, ?JsonSerializable $body = null, bool $isDownload = false): ResponseInterface
    {
        $options = $this->httpOptions;
        $headers = $this->headers;

        if ($this->requestAuth->canAuthorize()) {
            $headers[$this->requestAuth->getHeaderName()] = $this->requestAuth->getAuthType() . ' ' . $this->requestAuth->getAuthData();
        }

        if ($this->profileId !== null) {
            $headers['Amazon-Advertising-API-Scope'] = $this->profileId;
        }

        $options[RequestOptions::HEADERS] = $headers;

        if ($body !== null) {
            $options[RequestOptions::BODY] = CastType::toJson($body);
        }

        return $this->executeRequest($method, $url, $options, $isDownload);
    }

    /**
     * @param HttpMethod $method
     * @param string     $url
     * @param array      $options
     * @param bool       $isDownload
     * @param int        $attempt
     *
     * @throws ClassNotFoundException
     * @throws GuzzleException
     * @throws HttpException
     * @throws ReflectionException
     *
     * @return ResponseInterface
     */
    protected function executeRequest(HttpMethod $method, string $url, array $options, bool $isDownload = false, int $attempt = 0): ResponseInterface
    {
        $response   = $this->httpClient->request($method->getValue(), $url, $options);
        $statusCode = $response->getStatusCode();

        $this->lastRequestId = $this->getAmazonRequestId($response);

        if ( ! $this->shouldThrowHttpException($statusCode)) {
            return $response;
        }

        if ( ! $this->shouldThrottleRequests($statusCode, ++$attempt, $isDownload)) {
            $this->handleHttpError($response);
        }

        $retryAfter = $response->hasHeader('Retry-After') ? (int) $response->getHeader('Retry-After')[0] : 0;
        $this->snooze($this->throttleManager->getWaitTime($attempt, $retryAfter));

        return $this->executeRequest($method, $url, $options, $isDownload, $attempt);
    }

    /**
     * Determines if requests should be throttled based on the presence of a throttle manager,
     * the response code provided from the server, and whether the max attempts have been exhausted.
     *
     * @param int  $statusCode
     * @param int  $attempt
     * @param bool $isDownload
     *
     * @return bool
     */
    protected function shouldThrottleRequests(int $statusCode, int $attempt, bool $isDownload = false): bool
    {
        return ($this->httpResponseIsThrottleError($statusCode) || $this->httpResponseIsServerError($statusCode))
            && $this->throttleManager instanceof RequestThrottle
            && ( ! $isDownload ? true : $this->shouldThrottleDownloads())
            && $attempt < $this->throttleManager->getMaxAttempts($isDownload);
    }

    /**
     * @return bool
     */
    protected function shouldThrottleDownloads(): bool
    {
        return $this->throttleManager instanceof RequestThrottle && $this->throttleManager->shouldThrottleDownloads();
    }

    /**
     * Sleeps the process for the number of micro-seconds
     * provided in the $waitTime input property.
     *
     * @param int $waitTime Number of microseconds (1,000,000 == 1 second) to snooze
     */
    protected function snooze(int $waitTime): void
    {
        usleep($waitTime);
    }

    /**
     * Decode the response body based on the Content-Type header.
     *
     * @param ResponseInterface $response
     * @param MimeType|null     $type
     *
     * @throws InvalidArgumentException
     *
     * @return mixed
     */
    protected function decodeResponseBody(ResponseInterface $response, MimeType $type = null)
    {
        $type = $type === null ? $type : $type->getValue();

        switch ($type) {
            case MimeType::JSON:
            case MimeType::OCTET_STREAM:
                // TODO Do gzdecode on OCTET_STREAM
                return CastType::fromJson(CastType::toString($response->getBody()));
            case MimeType::TEXT_PLAIN:
                return CastType::toString($response->getBody());
            default:
                return $response->getBody();
        }
    }

    /**
     * Attempt to decode the report data.
     * If the response body cannot be json_decoded then it should be gzipped.
     *
     * @param ResponseInterface $reportResponse
     * @param string            $location
     *
     * @throws InvalidArgumentException
     * @throws ReportGZDecodeError
     *
     * @return mixed
     */
    protected function decodeReport(ResponseInterface $reportResponse, string $location)
    {
        $body = $this->decodeResponseBody($reportResponse, MimeType::TEXT_PLAIN());

        return CastType::fromJson($body) ?? CastType::fromJson($this->gzdecode($body, $location));
    }

    /**
     * Attempt to decode the gzipped report data.
     *
     * @param string $data
     * @param string $location
     *
     * @throws ReportGZDecodeError
     *
     * @return string
     */
    protected function gzdecode(string $data, string $location): string
    {
        $decoded = gzdecode($data);
        if ($decoded === false) {
            throw new ReportGZDecodeError('Error decoding report data.', $data, $location);
        }

        return $decoded;
    }
}
