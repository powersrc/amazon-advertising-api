<?php

declare(strict_types=1);

namespace PowerSrc\AmazonAdvertisingApi\Exceptions;

use Exception;

class ClassNotFoundException extends Exception
{
    /**
     * Name of the class that was unable to be found.
     *
     * @var string
     */
    private $classname;

    /**
     * @param string $classname Name of class that was not found
     */
    public function __construct(string $message, string $classname)
    {
        parent::__construct($message);

        $this->classname = $classname;
    }

    /**
     * Returns the name of the class that was unable to be found.
     */
    public function getClassname(): string
    {
        return $this->classname;
    }
}
