<?php
require_once('bootstrap.php');
use DependencyInjection\Container;

$container =  new Container();
$container->define('Bar', array('bar' => 'string'));

$foo = $container->get('Foo');
$foo->printBar();
