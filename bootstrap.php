<?php
if (php_sapi_name() !== 'cli') {
    die('This script only works from command-line interface.');
}

$root = realpath(__DIR__);
if ($root === false) {
    die('Failed to find root folder');
}

$_SERVER['DOCUMENT_ROOT'] = $root;

require_once ($_SERVER['DOCUMENT_ROOT'] . '/utility/loader.php');
