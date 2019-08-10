<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 6/11/2018
 * Time: 1:39 PM
 */

namespace henrik\component;

/**
 * Interface ComponentInterface
 * @package henrik\component
 */
interface ComponentInterface
{
    /**
     * @param $name
     * @param bool $checkVars
     * @return mixed
     */
    public function canGetProperty($name, $checkVars = true);

    /**
     * @param $name
     * @param bool $checkVars
     * @return mixed
     */
    public function canSetProperty($name, $checkVars = true);

    /**
     * @param $name
     * @return mixed
     */
    public function hasMethod($name);

    /**
     * @param $name
     * @param bool $checkVars
     * @return mixed
     */
    public function hasProperty($name, $checkVars = true);

    /**
     * @return mixed
     */
    public function getClassName();
}