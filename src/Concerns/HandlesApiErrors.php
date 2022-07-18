<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Concerns;

use Exception;
use InvalidArgumentException;
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

trait HandlesApiErrors
{
    protected $amzHeaderShort = 'x-amz-rid';
    protected $amzHeaderFull  = 'x-amz-request-id';

    /**
     * @throws ClassNotFoundException
     * @throws InvalidArgumentException
     * @throws ReflectionException
     */
    protected function handleHttpError(ResponseInterface $response, ?string $message = null, ?int $status = null): void
    {
        $error = $this->responseCanBeParsed($response) ? new Error(CastType::fromJson(CastType::toString($response->getBody()))) : null;

        $message = $message ?? (Data::get($error, 'code') . ': ' . (Data::get($error, 'details') ?? Data::get($error, 'description')));

        $e = $this->getHttpExceptionFor($response, $message, $status);
        $e->setErrorResponse($error);

        throw $e;
    }

    protected function shouldThrowHttpException(int $statusCode): bool
    {
        return $this->httpResponseIsInformational($statusCode)
               || $this->httpResponseIsClientError($statusCode)
               || $this->httpResponseIsServerError($statusCode);
    }

    protected function httpResponseIsInformational(int $statusCode): bool
    {
        return $statusCode < 200;
    }

    protected function httpResponseIsSuccess(int $statusCode): bool
    {
        return $statusCode >= 200 && $statusCode < 300;
    }

    protected function httpResponseIsRedirect(int $statusCode): bool
    {
        return $statusCode >= 300 && $statusCode < 400;
    }

    protected function httpResponseIsClientError(int $statusCode): bool
    {
        return $statusCode >= 400 && $statusCode < 500;
    }

    protected function httpResponseIsServerError(int $statusCode): bool
    {
        return $statusCode >= 500;
    }

    protected function httpResponseIsThrottleError(int $statusCode): bool
    {
        return $statusCode === 429;
    }

    protected function getAmazonRequestId(ResponseInterface $response): ?string
    {
        $getRequestId = function (string $name) use ($response): ?string {
            return $response->getHeader($name)[0] ?? null;
        };

        return $getRequestId($this->amzHeaderShort) ?? $getRequestId($this->amzHeaderFull);
    }

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

    private function getHeaderStringValue(array $headers, string $name): ?string
    {
        return ! empty($headers[$name]) ? \implode(',', $headers[$name]) : null;
    }

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
                $e = new BadRequestHttpException($message, $previous, $code, $headers);
                break;
            case 401:
                $e = new UnauthorizedHttpException($this->getHeaderStringValue($headers, 'WWW-Authenticate') ?? 'Bearer', $message, $previous, $code, $headers);
                break;
            case 403:
                $e = new AccessDeniedHttpException($message, $previous, $code, $headers);
                break;
            case 404:
                $e = new NotFoundHttpException($message, $previous, $code, $headers);
                break;
            case 405:
                $e = new MethodNotAllowedHttpException($headers['Allow'] ?? [], $message, $previous, $code, $headers);
                break;
            case 406:
                $e = new NotAcceptableHttpException($message, $previous, $code, $headers);
                break;
            case 409:
                $e = new ConflictHttpException($message, $previous, $code, $headers);
                break;
            case 410:
                $e = new GoneHttpException($message, $previous, $code, $headers);
                break;
            case 411:
                $e = new LengthRequiredHttpException($message, $previous, $code, $headers);
                break;
            case 412:
                $e = new PreconditionFailedHttpException($message, $previous, $code, $headers);
                break;
            case 415:
                $e = new UnsupportedMediaTypeHttpException($message, $previous, $code, $headers);
                break;
            case 422:
                $e = new UnprocessableEntityHttpException($message, $previous, $code, $headers);
                break;
            case 428:
                $e = new PreconditionRequiredHttpException($message, $previous, $code, $headers);
                break;
            case 429:
                $e = new TooManyRequestsHttpException($this->getHeaderStringValue($headers, 'Retry-After'), $message, $previous, $code, $headers);
                break;
            case 503:
                $e = new ServiceUnavailableHttpException($this->getHeaderStringValue($headers, 'Retry-After'), $message, $previous, $code, $headers);
                break;
            default:
                $e = new HttpException($status, $message, $previous, $headers, $code);
        }

        return $e;
    }
}
