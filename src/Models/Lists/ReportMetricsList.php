<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\Lists;

use ArrayAccess;
use ArrayIterator;
use Countable;
use ErrorException;
use InvalidArgumentException;
use IteratorAggregate;
use JsonSerializable;
use PowerSrc\AmazonAdvertisingApi\Contracts\Arrayable;
use PowerSrc\AmazonAdvertisingApi\Contracts\Jsonable;
use PowerSrc\AmazonAdvertisingApi\Enums\ReportMetric;
use PowerSrc\AmazonAdvertisingApi\Enums\ReportRecordType;
use PowerSrc\AmazonAdvertisingApi\Exceptions\InvalidMetricException;
use PowerSrc\AmazonAdvertisingApi\Support\CastType;
use ReflectionException;
use function array_walk;
use function implode;
use function is_string;
use function sprintf;

abstract class ReportMetricsList implements ArrayAccess, Arrayable, Countable, Jsonable, JsonSerializable, IteratorAggregate
{
    /**
     * @var ReportMetric[]
     */
    protected $metricList = [];

    /**
     * The ReportRecordType the metrics belong to.
     *
     * @var ReportRecordType
     */
    private $reportRecordType;

    /**
     * @param ReportMetric[]|string[] $metrics
     */
    public function __construct(array $metrics = [])
    {
        $this->reportRecordType = $this->getReportRecordType();

        array_walk($metrics, function ($metric) {
            $this->addMetric($metric);
        });
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Magic methods:
    |-------------------------------------------------------------------------------------------------------------------
    */

    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * @param ReportMetric|string $metric
     *
     * @throws InvalidMetricException
     * @throws ReflectionException
     *
     * @return ReportMetricsList
     */
    public function addMetric($metric): ReportMetricsList
    {
        $this->metricList[] = $this->getMetric($metric);

        return $this;
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | ArrayAccess implementation:
    |-------------------------------------------------------------------------------------------------------------------
    */

    /**
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->metricList[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @throws ErrorException
     *
     * @return ReportMetric
     */
    public function offsetGet($offset): ReportMetric
    {
        if ( ! $this->offsetExists($offset)) {
            throw new ErrorException('Undefined offset: ' . $offset);
        }

        return $this->metricList[$offset];
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws InvalidMetricException
     * @throws ReflectionException
     */
    public function offsetSet($offset, $value): void
    {
        $this->metricList[$offset] = $this->getMetric($value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->metricList[$offset]);
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Arrayable implementation:
    |-------------------------------------------------------------------------------------------------------------------
    */

    public function toArray(): array
    {
        return $this->metricList;
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Countable implementation:
    |-------------------------------------------------------------------------------------------------------------------
    */

    public function count(): int
    {
        return count($this->itemList);
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | Jsonable implementation:
    |-------------------------------------------------------------------------------------------------------------------
    */

    public function toJson(int $options = 0): string
    {
        return CastType::toJson($this->jsonSerialize(), $options);
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | JsonSerializable implementation:
    |-------------------------------------------------------------------------------------------------------------------
    */

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /*
    |-------------------------------------------------------------------------------------------------------------------
    | IteratorAggregate implementation:
    |-------------------------------------------------------------------------------------------------------------------
    */

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->metricList);
    }

    /**
     * Return the ReportRecordType the metrics belong to.
     *
     * @return ReportRecordType
     */
    abstract protected function getReportRecordType(): ReportRecordType;

    /**
     * @param ReportMetric|string $metric
     *
     * @throws InvalidMetricException
     * @throws ReflectionException
     *
     * @return ReportMetric
     */
    protected function getMetric($metric): ReportMetric
    {
        /*
         * If the input is not a string or ReportMetric, throw.
         */
        if ( ! is_string($metric) && ! $metric instanceof ReportMetric) {
            throw new InvalidArgumentException(
                sprintf('Invalid metric type. Must be one of [`string`, `%s`].', ReportMetric::class)
            );
        }

        /*
         * If the input is a string, attempt to instantiate an instance of the ReportMetric and return it.
         */
        if (is_string($metric)) {
            return $this->getValidMetricByString($metric);
        }

        /*
         * If the input is an invalid ReportMetric for the ReportType, throw.
         */
        if ( ! $metric->belongsTo($this->reportRecordType)) {
            $this->throwInvalidMetricException($metric);
        }

        /*
         * The input value must be a valid metric type.
         */
        return $metric;
    }

    /**
     * @param string $metric
     *
     * @throws InvalidMetricException
     * @throws ReflectionException
     *
     * @return ReportMetric
     */
    private function getValidMetricByString(string $metric): ReportMetric
    {
        if ( ! ReportMetric::isValidFor($this->reportRecordType, $metric)) {
            $this->throwInvalidMetricException($metric);
        }

        return ReportMetric::for($metric);
    }

    /**
     * @param ReportMetric|string $metric
     *
     * @throws InvalidMetricException
     */
    private function throwInvalidMetricException($metric)
    {
        $metric = is_string($metric) ? $metric : $metric->getValue();
        throw new InvalidMetricException(
            sprintf(
                'Invalid metric `%s` for `%s` report type. Must be one of [`%s`]',
                $metric, $this->reportRecordType->getValue(),
                implode('`,`', ReportMetric::getValidMetricsFor($this->reportRecordType))
            )
        );
    }
}
