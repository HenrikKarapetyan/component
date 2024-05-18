<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 2/7/2018
 * Time: 12:53 PM.
 */

namespace Henrik\Component;

use Henrik\Component\Exceptions\InvalidCallException;
use Henrik\Component\Exceptions\ReadOnlyPropertyCallException;
use Henrik\Component\Exceptions\UnknownMethodException;
use Henrik\Component\Exceptions\UnknownPropertyException;

/**
 * Class Component.
 */
class Component implements ComponentInterface
{
    /**
     * @param string $name
     *
     * @throws UnknownPropertyException
     * @throws InvalidCallException
     *
     * @return mixed
     */
    public function __get(string $name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->{$getter}();
        }
        if (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException(get_class($this), $name);
        }

        throw new UnknownPropertyException(get_class($this), $name);
    }

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @throws ReadOnlyPropertyCallException
     * @throws UnknownPropertyException
     */
    public function __set(string $name, mixed $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->{$setter}($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new ReadOnlyPropertyCallException(get_class($this), $name);
        }

        throw new UnknownPropertyException(get_class($this), $name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->{$getter}() !== null;
        }

        return false;
    }

    /**
     * @param string $name
     *
     * @throws InvalidCallException
     */
    public function __unset(string $name)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->{$setter}(null);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException(get_class($this), $name);
        }
    }

    /**
     * @param string                   $name
     * @param array<int|string, mixed> $params
     *
     * @throws UnknownMethodException
     */
    public function __call(string $name, array $params): void
    {
        throw new UnknownMethodException(get_class($this), $name);
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return get_called_class();
    }

    /**
     * @param string $name
     * @param bool   $checkVars
     *
     * @return bool
     */
    public function hasProperty(string $name, bool $checkVars = true): bool
    {
        return $this->canGetProperty($name, $checkVars) || $this->canSetProperty($name, false);
    }

    /**
     * @param string $name
     * @param bool   $checkVars
     *
     * @return bool
     */
    public function canGetProperty(string $name, bool $checkVars = true): bool
    {
        return method_exists($this, 'get' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * @param string $name
     * @param bool   $checkVars
     *
     * @return bool
     */
    public function canSetProperty(string $name, bool $checkVars = true): bool
    {
        return method_exists($this, 'set' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasMethod(string $name): bool
    {
        return method_exists($this, $name);
    }
}