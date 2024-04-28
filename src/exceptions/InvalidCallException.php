<?php


namespace henrik\component\exceptions;

use Throwable;

/**
 * Class InvalidCallException
 * @package henrik\component\exceptions
 */
class InvalidCallException extends ComponentException
{
    public function __construct($class, $propertyName, $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Operation on read-only property: %s::%s', $class, $propertyName);
        parent::__construct($message, $code, $previous);
    }
}