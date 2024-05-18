<?php

namespace Henrik\Component\Exceptions;

use Throwable;

class UnknownMethodException extends ComponentException
{
    public function __construct(string $class, string $propertyName, int $code = 0, ?Throwable $previous = null)
    {
        $message = sprintf('Calling unknown method: %s::%s', $class, $propertyName);
        parent::__construct($message, $code, $previous);
    }
}