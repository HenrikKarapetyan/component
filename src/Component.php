<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 2/7/2018
 * Time: 12:53 PM
 */

namespace henrik\component;

use henrik\component\exceptions\InvalidCallException;
use henrik\component\exceptions\ReadOnlyPropertyCallException;
use henrik\component\exceptions\UnknownMethodException;
use henrik\component\exceptions\UnknownPropertyException;

/**
 * Class Component
 * @package henrik\component
 */
class Component implements ComponentInterface
{
    /**
     * @return string
     */
    public function getClassName(): string
    {
        return get_called_class();
    }

    /**
     * @param $name
     * @return mixed
     * @throws InvalidCallException
     * @throws UnknownPropertyException
     */
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        } elseif (method_exists($this, 'set' . $name)) {
            throw new InvalidCallException(get_class($this), $name);
        }

        throw new UnknownPropertyException(get_class($this), $name);
    }

    /**
     * @param $name
     * @param $value
     * @throws InvalidCallException
     * @throws UnknownPropertyException|ReadOnlyPropertyCallException
     */
    public function __set($name, $value)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter($value);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new ReadOnlyPropertyCallException(get_class($this), $name);
        } else {
            throw new UnknownPropertyException(get_class($this), $name);
        }
    }


    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        }

        return false;
    }

    /**
     * @param $name
     * @throws InvalidCallException
     */
    public function __unset($name)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter(null);
        } elseif (method_exists($this, 'get' . $name)) {
            throw new InvalidCallException(get_class($this), $name);
        }
    }

    /**
     * @param $name
     * @param $params
     * @throws UnknownMethodException
     */
    public function __call($name, $params)
    {
        throw new UnknownMethodException(get_class($this), $name);
    }


    /**
     * @param string $name
     * @param bool $checkVars
     * @return bool
     */
    public function hasProperty(string $name, bool $checkVars = true): bool
    {
        return $this->canGetProperty($name, $checkVars) || $this->canSetProperty($name, false);
    }

    /**
     * @param $name
     * @param bool $checkVars
     * @return bool
     */
    public function canGetProperty($name, bool $checkVars = true): bool
    {
        return method_exists($this, 'get' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * @param $name
     * @param bool $checkVars
     * @return bool
     */
    public function canSetProperty($name, bool $checkVars = true): bool
    {
        return method_exists($this, 'set' . $name) || $checkVars && property_exists($this, $name);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasMethod(string $name): bool
    {
        return method_exists($this, $name);
    }
}