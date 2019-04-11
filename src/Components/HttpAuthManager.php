<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Components;

use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use PowerSrc\AmazonAdvertisingApi\Concerns\HandlesApiErrors;
use PowerSrc\AmazonAdvertisingApi\Contracts\HttpRequestAuth;
use PowerSrc\AmazonAdvertisingApi\Enums\HttpMethod;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Models\LWAAuthResponse;
use PowerSrc\AmazonAdvertisingApi\Support\CastType;
use ReflectionException;
use Throwable;
use function array_merge;
use function time;

final class HttpAuthManager implements HttpRequestAuth
{
    use HandlesApiErrors;

    /**
     * Amazon request identifier of the last request.
     *
     * @var string|null
     */
    protected $lastRequestId;

    /**
     * @var HttpClientInterface
     */
    private $httpClient;

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $clientSecret;

    /**
     * @var string
     */
    private $refreshToken;

    /**
     * @var string|null
     */
    private $accessToken;

    /**
     * @var int|null
     */
    private $validTill;

    public function __construct(HttpClientInterface $httpClient, string $clientId, string $clientSecret, string $refreshToken, ?string $accessToken = null, ?int $validTill = null)
    {
        $this->httpClient   = $httpClient;
        $this->clientId     = $clientId;
        $this->clientSecret = $clientSecret;
        $this->accessToken  = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->validTill    = $validTill;
    }

    /**
     * Return the current access token.
     *
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Return the current timestamp expiration of the access token.
     *
     * @return int|null
     */
    public function getValidTill(): ?int
    {
        return $this->validTill;
    }

    /**
     * Determines whether authentication information is present.
     *
     * @return bool
     */
    public function canAuthorize(): bool
    {
        return $this->authTokenIsValid();
    }

    /**
     * Gets the name of the header needed to use for authorization.
     *
     * @return string
     */
    public function getHeaderName(): string
    {
        return 'Authorization';
    }

    /**
     * Gets the authentication type.
     *
     * @return string
     */
    public function getAuthType(): string
    {
        return 'Bearer';
    }

    /**
     * Gets the authentication data.
     *
     * @throws ClassNotFoundException
     * @throws GuzzleException
     * @throws ReflectionException
     *
     * @return null|string
     */
    public function getAuthData(): ?string
    {
        if ($this->authTokenIsExpired()) {
            $this->refreshAuthToken();
        }

        return $this->accessToken;
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
     * Gets the LWA client identifier.
     *
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * Calls the Amazon oauth endpoint to refresh the access token.
     *
     * @throws GuzzleException
     * @throws ClassNotFoundException
     * @throws ReflectionException
     */
    private function refreshAuthToken(): void
    {
        $params = [
            'grant_type'    => 'refresh_token',
            'refresh_token' => $this->refreshToken,
            'client_id'     => $this->clientId,
            'client_secret' => $this->clientSecret,
        ];
        $options = array_merge([
            RequestOptions::HEADERS     => ['Accept' => MimeType::JSON],
            RequestOptions::HTTP_ERRORS => false,
            'curl'                      => [CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2],
        ], $params ? [RequestOptions::FORM_PARAMS => $params] : []);

        $response = $this->httpClient->request(HttpMethod::POST, 'https://api.amazon.com/auth/o2/token', $options);

        $this->lastRequestId = $this->getAmazonRequestId($response);

        if ( ! $this->responseCanBeParsed($response)) {
            $this->handleHttpError($response, 'Login with Amazon returned an unparsable response', 406);
        }

        $lwaAuthResponse = new LWAAuthResponse(CastType::fromJson(CastType::toString($response->getBody())));
        if ($this->shouldThrowHttpException($response->getStatusCode()) || $lwaAuthResponse->isErrorResponse()) {
            $this->handleHttpError($response, $lwaAuthResponse->error_description, $lwaAuthResponse->getErrorCode());
        }

        $this->accessToken = $lwaAuthResponse->access_token;
        $this->validTill   = $lwaAuthResponse->validTill;
    }

    /**
     * @return bool
     */
    private function authTokenIsValid(): bool
    {
        if ( ! $this->authTokenIsExpired()) {
            return true;
        }

        try {
            $this->refreshAuthToken();
        } catch (GuzzleException $e) {
            return false;
        } catch (Throwable $e) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    private function authTokenIsExpired(): bool
    {
        return $this->validTill === null || (int) $this->validTill < time();
    }
}
