<?php


use ravenitsystems\bedrock_object_manager\Storage;
use PHPUnit\Framework\TestCase;

class StorageTest extends TestCase
{

    public function testModule()
    {
        $storage = new Storage();
        $this->assertEquals('default', $storage->module(), 'Initially the module will be set to default');
        $storage->module('new_module');
        $this->assertEquals('new_module', $storage->module(), 'The module should now be changed to new_module');
        $storage->module('');
        $this->assertEquals('default', $storage->module(), 'Empty string should set module to default');
    }

    public function testObjectList()
    {
        $this->assertEquals(1, 1);
    }

    public function testInstance()
    {
        $storage = new Storage();
        $this->assertEquals('default', $storage->instance(), 'Initially the instance will be set to default');
        $storage->instance('new_instance');
        $this->assertEquals('new_instance', $storage->instance(), 'The instance should now be changed to new_instance');
        $storage->instance('');
        $this->assertEquals('default', $storage->instance(), 'Empty string should set instance to default');
        $storage->module('test_module');
        $this->assertEquals('test_module', $storage->module(), 'Changed module to test module');
        $storage->instance('test_instance');
        $this->assertEquals('test_instance', $storage->instance(), 'Instance should have changed to test_instance');
        $this->assertEquals('default', $storage->module(), 'Module should now be default after changing instance');
    }

    public function testSet()
    {
        $this->assertEquals(1, 1);
    }

    public function testGet()
    {
        $this->assertEquals(1, 1);
    }

    public function testDel()
    {
        $this->assertEquals(1, 1);
    }

    public function testAll()
    {
        $this->assertEquals(1, 1);
    }

    public function testModuleList()
    {
        $this->assertEquals(1, 1);
    }

    public function testHas()
    {
        $this->assertEquals(1, 1);
    }

    public function setUp(): void
    {
        require(__DIR__ . '/../vendor/autoload.php');
    }
}
