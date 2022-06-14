<?php

require(__DIR__ . '/../vendor/autoload.php');

$s = new \ravenitsystems\bedrock_object_manager\Storage();

$s->instance('test');

$s->module('api');

$s->set('nick', 'SOME LONG TEXT');
$s->set('nick2', 'SOME LONG TEXT');

$s->module('api');


var_export($s->all());

//$s->dump();

die();

$s->setUseStatic(false);

$s->set("test", "Nicholas");

print PHP_EOL . PHP_EOL . "STATIC" . PHP_EOL;
$s->dump(true);
print PHP_EOL . PHP_EOL . "NON STATIC" . PHP_EOL;
$s->dump(false);