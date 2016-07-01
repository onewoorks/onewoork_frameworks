<?php

$params = explode('/', $_SERVER['REQUEST_URI']);
$request = $_SERVER['QUERY_STRING'];
$parsed = explode('&', $request);
$page = array_shift($parsed);
$logid = isset($_SESSION['uid']);

$getVars = array();

foreach ($parsed as $argument) {
    list($variable, $value) = explode('=', $argument);
    $getVars[$variable] = urldecode($value);
}


$page = ($logid) ? 'main' : 'login' ; //change to 1st main to login back if database is setup
$target = SERVER_ROOT . '/application/controllers/' . $page . '.php';

function __autoload($className) {
    list($suffix, $filename) = preg_split('/_/', strrev($className), 2);
    $filename = strrev($filename);
    $suffix = strrev($suffix);
    switch (strtolower($suffix)) {
        case 'model':
            $folder = 'application/models/';
            break;
        case 'library':
            $folder = 'application/libraries/';
            break;
        case 'driver':
            $folder = 'application/libraries/drivers/';
            break;
        case 'utils':
            $folder = 'application/utils/';
            break;
        case 'functions':
            $folder = 'application/libraries/functions/';
            break;
        case 'controller':
            $folder = 'application/controllers/';
            break;
    }
    $file = SERVER_ROOT . $folder . strtolower($filename) . '.php';

    if (file_exists($file)) {
        include_once($file);
    } else {
        die("File '$filename' containing class '$className' not found in '$folder'.");
    }
}

if (file_exists($target)) {
    include_once($target);
    $class = ucfirst($page) . '_Controller';
    class_exists($class) ? $controller = new $class : die('class does not exist!');
} else {
    die($page . ' page does not exist!');
}
$controller->main($getVars, $params);
?>