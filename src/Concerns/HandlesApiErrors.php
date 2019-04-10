<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use Exception;
use PowerSrc\AmazonAdvertisingApi\Enums\MimeType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\AccessDeniedHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\BadRequestHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ClassNotFoundException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ConflictHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\GoneHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\HttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\LengthRequiredHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\MethodNotAllowedHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\NotAcceptableHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\NotFoundHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\PreconditionFailedHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\PreconditionRequiredHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\ServiceUnavailableHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\TooManyRequestsHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\UnauthorizedHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\UnprocessableEntityHttpException;
use PowerSrc\AmazonAdvertisingApi\Exceptions\UnsupportedMediaTypeHttpException;
use PowerSrc\AmazonAdvertisingApi\Models\Error;
use PowerSrc\AmazonAdvertisingApi\Support\CastType;
use PowerSrc\AmazonAdvertisingApi\Support\Data;
use PowerSrc\AmazonAdvertisingApi\Support\Str;
use Psr\Http\Message\ResponseInterface;
use ReflectionException;
use function implode;

trait HandlesApiErrors
{
    protected $amzHeaderShort = 'x-amz-rid';
    protected $amzHeaderFull  = 'x-amz-request-id';

    /**
     * @param ResponseInterface $response
     * @param string|null       $message
     * @param int|null          $status
     *
     * @throws ClassNotFoundException
     * @throws HttpException
     * @throws ReflectionException
     */
    protected function handleHttpError(ResponseInterface $response, ?string $message = null, ?int $status = null): void
    {
        $error = $this->responseCanBeParsed($response) ? new Error(CastType::fromJson(CastType::toString($response->getBody()))) : null;

        $message = $message ?? (Data::get($error, 'code') . ': ' . (Data::get($error, 'details') ?? Data::get($error, 'description')));

        throw $this->getHttpExceptionFor($response, $message, $status)->setErrorResponse($error);
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function shouldThrowHttpException(int $statusCode): bool
    {
        return $this->httpResponseIsInformational($statusCode)
               || $this->httpResponseIsClientError($statusCode)
               || $this->httpResponseIsServerError($statusCode);
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function httpResponseIsInformational(int $statusCode): bool
    {
        return $statusCode < 200;
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function httpResponseIsSuccess(int $statusCode): bool
    {
        return $statusCode >= 200 && $statusCode < 300;
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function httpResponseIsRedirect(int $statusCode): bool
    {
        return $statusCode >= 300 && $statusCode < 400;
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function httpResponseIsClientError(int $statusCode): bool
    {
        return $statusCode >= 400 && $statusCode < 500;
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function httpResponseIsServerError(int $statusCode): bool
    {
        return $statusCode >= 500;
    }

    /**
     * @param int $statusCode
     *
     * @return bool
     */
    protected function httpResponseIsThrottleError(int $statusCode): bool
    {
        return $statusCode === 429;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return string|null
     */
    protected function getAmazonRequestId(ResponseInterface $response): ?string
    {
        $getRequestId = function (string $name) use ($response): ?string {
            return $response->getHeader($name)[0] ?? null;
        };

        return $getRequestId($this->amzHeaderShort) ?? $getRequestId($this->amzHeaderFull);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return bool
     */
    protected function responseCanBeParsed(ResponseInterface $response): bool
    {
        return $response->hasHeader('Content-Type')
               && Str::startsWith($response->getHeader('Content-Type')[0], MimeType::JSON);
    }

    private function getHttpExceptionFor(ResponseInterface $response, ?string $message = null, ?int $status = null): HttpException
    {
        return $this->getHttpException(
            $status ?? $response->getStatusCode(),
            $message ?? $response->getReasonPhrase(),
            null,
            0,
            $response->getHeaders()
        );
    }

    /**
     * @param array  $headers
     * @param string $name
     *
     * @return string|null
     */
    private function getHeaderStringValue(array $headers, string $name): ?string
    {
        return ! empty($headers[$name]) ? implode(',', $headers[$name]) : null;
    }

    /**
     * @param int            $status
     * @param string|null    $message
     * @param Exception|null $previous
     * @param int            $code
     * @param array          $headers
     *
     * @return HttpException
     */
    private function getHttpException(int $status, ?string $message = null, ?Exception $previous = null, int $code = 0, array $headers = []): HttpException
    {
        $requestId = $this->getHeaderStringValue($headers, $this->amzHeaderShort) ?? $this->getHeaderStringValue($headers, $this->amzHeaderFull);

        if ($message === null) {
            $message = $requestId ? 'Amazon Request Id: `' . $requestId . '`' : null;
        } else {
            $message = $message . ($requestId ? ' (Amazon Request Id: `' . $requestId . '`)' : '');
        }

        switch ($status) {
            case 400:
                return new BadRequestHttpException($message, $previous, $code, $headers);
            case 401:
                return new UnauthorizedHttpException($this->getHeaderStringValue($headers, 'WWW-Authenticate') ?? 'Bearer', $message, $previous, $code, $headers);
            case 403:
                return new AccessDeniedHttpException($message, $previous, $code, $headers);
            case 404:
                return new NotFoundHttpException($message, $previous, $code, $headers);
            case 405:
                return new MethodNotAllowedHttpException($headers['Allow'] ?? [], $message, $previous, $code, $headers);
            case 406:
                return new NotAcceptableHttpException($message, $previous, $code, $headers);
            case 409:
                return new ConflictHttpException($message, $previous, $code, $headers);
            case 410:
                return new GoneHttpException($message, $previous, $code, $headers);
            case 411:
                return new LengthRequiredHttpException($message, $previous, $code, $headers);
            case 412:
                return new PreconditionFailedHttpException($message, $previous, $code, $headers);
            case 415:
                return new UnsupportedMediaTypeHttpException($message, $previous, $code, $headers);
            case 422:
                return new UnprocessableEntityHttpException($message, $previous, $code, $headers);
            case 428:
                return new PreconditionRequiredHttpException($message, $previous, $code, $headers);
            case 429:
                return new TooManyRequestsHttpException($this->getHeaderStringValue($headers, 'Retry-After'), $message, $previous, $code, $headers);
            case 503:
                return new ServiceUnavailableHttpException($this->getHeaderStringValue($headers, 'Retry-After'), $message, $previous, $code, $headers);
        }

        return new HttpException($status, $message, $previous, $headers, $code);
    }
}
