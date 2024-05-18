<?php

namespace Henrik\Component\Exceptions;

use Throwable;

/**
 * Class InvalidCallException.
 */
class InvalidCallException extends ComponentException
{
    public function __construct(string $class, string $propertyName, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Operation on read-only property: %s::%s', $class, $propertyName);
        parent::__construct($message, $code, $previous);
    }
}