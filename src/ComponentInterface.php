<?php
/**
 * Created by PhpStorm.
 * User: Henrik
 * Date: 6/11/2018
 * Time: 1:39 PM.
 */

namespace Henrik\Component;

/**
 * Interface ComponentInterface.
 */
interface ComponentInterface
{
    /**
     * @param string $name
     * @param bool   $checkVars
     *
     * @return bool
     */
    public function canGetProperty(string $name, bool $checkVars = true): bool;

    /**
     * @param string $name
     * @param bool   $checkVars
     *
     * @return bool
     */
    public function canSetProperty(string $name, bool $checkVars = true): bool;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasMethod(string $name): bool;

    /**
     * @param string $name
     * @param bool   $checkVars
     *
     * @return bool
     */
    public function hasProperty(string $name, bool $checkVars = true): bool;

    /**
     * @return string
     */
    public function getClassName(): string;
}