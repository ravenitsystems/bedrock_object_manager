<?php

namespace ravenitsystems\bedrock_object_manager;

use Exception;

/**
 *
 */
class Storage implements IStorage
{
    /**
     * @var array
     */
    private static array $store = [];
    /**
     * @var string
     */
    private string $instance = 'default';
    /**
     * @var string
     */
    private string $module = 'default';

    /**
     * @param string $name
     * @return object|callable|string
     * @throws Exception
     */
    public function get(string $name): object|callable|string
    {
        $this->check_internal_structure();
        if (!array_key_exists($name, self::$store[$this->instance][$this->module])) {
            throw new Exception("Object does not exist");
        }
        $object = self::$store[$this->instance][$this->module][$name];
        if (is_object($object) == false && is_callable($object) == false && is_string($object) == false) {
            throw new Exception("Unexpected type stored");
        }
        return $object;
    }

    /**
     * Sets the data under a given name to the static storage
     * @param string $name
     * @param callable|object|string $object
     * @return void
     * @throws Exception
     */
    public function set(string $name, callable|object|string $object): void
    {
        $this->check_internal_structure();
        self::$store[$this->instance][$this->module][$name] = $object;
    }

    /**
     * Returns a true or false value to signify if a given object exists
     * @param string $name
     * @return bool
     * @throws Exception
     */
    public function has(string $name): bool
    {
        $this->check_internal_structure();
        return array_key_exists($name, self::$store[$this->instance][$this->module]);
    }

    /**
     * Delete an entry and return the item that has been removed
     * @param string $name
     * @return object|callable|string
     * @throws Exception
     */
    public function del(string $name): object|callable|string
    {
        $this->check_internal_structure();
        $object = $this->get($name);
        unset(self::$store[$this->instance][$this->module][$name]);
        return $object;
    }

    /**
     * Returns all the data stored for the current instance
     * @return array
     * @throws Exception
     */
    public function all(): array
    {
        $this->check_internal_structure();
        return self::$store[$this->instance];
    }

    /**
     * Returns a list of object names that exist and can be addressed
     * @return array
     * @throws Exception
     */
    public function objectList(): array
    {
        $this->check_internal_structure();
        return array_keys(self::$store[$this->instance][$this->module]);
    }

    /**
     * Returns a list of module names that exist and can be addressed
     * @return array
     * @throws Exception
     */
    public function moduleList(): array
    {
        $this->check_internal_structure();
        return array_keys(self::$store[$this->instance]);
    }

    /**
     * Gets or Sets the instance the class is currently using
     * @param string|null $instance
     * @return string|null
     * @throws Exception
     */
    public function instance(?string $instance = null): ?string
    {
        if (is_string($instance)) {
            $this->instance = $instance == '' ? 'default' : $instance;
            $this->check_internal_structure();
        }
        return $this->instance;
    }

    /**
     * Gets or Sets the module the class is currently using.
     * @param string|null $module
     * @return string|null
     * @throws Exception
     */
    public function module(?string $module = null): ?string
    {
        if (is_string($module)) {
            $this->module = $module == '' ? 'default' : $module;
            $this->check_internal_structure();
        }
        return $this->module;
    }

    /**
     * Ensures that the currently selected instance and module combination has an entry in the static store array, if
     * there is no entry then a new one is created as an empty array. If for some reason the instance and module part of
     * the data structure is not an array an exception is thrown.
     * @return void
     * @throws Exception
     */
    private function check_internal_structure(): void
    {
        if (!array_key_exists($this->instance, self::$store)) {
            self::$store[$this->instance] = [];
        }
        if (!is_array(self::$store[$this->instance])) {
            throw new Exception("Structure issues");
        }
        if (!array_key_exists($this->module, self::$store[$this->instance])) {
            self::$store[$this->instance][$this->module] = [];
        }
        if (!is_array(self::$store[$this->instance][$this->module])) {
            throw new Exception("Structure issues");
        }
    }

}