<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Models\RequestParams;

use PowerSrc\AmazonAdvertisingApi\Enums\State;

final class SnapshotParams extends RequestParams
{
    /**
     * The list of parameter names and default values.
     *
     * @var array
     */
    protected $params = [
        'stateFilter'       => [],
    ];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array
     */
    protected $map = [
        'stateFilter'       => 'addStates',
    ];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array
     */
    protected $filters = [
        'stateFilter',
    ];

    /**
     * @param State[] $states
     *
     * @return SnapshotParams
     */
    public function addStates(array $states): self
    {
        $states = (function (State ...$states) {
            return $states;
        })(...$states);

        foreach ($states as $state) {
            $this->addState($state);
        }

        return $this;
    }

    /**
     * @param State $state
     *
     * @return SnapshotParams
     */
    public function addState(State $state): self
    {
        $this->params['stateFilter'][] = $state;

        return $this;
    }
}
