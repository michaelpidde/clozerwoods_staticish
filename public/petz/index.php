<?php

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $uri);
array_shift($parts); // Remove ""
array_shift($parts); // Remove "petz"
$route = implode('/', $parts);
if($route === '') {
    $route = 'home';
}

$file = "{$route}.php";
if(file_exists($file)) {
    require $file;
    exit();
} else {
    if(file_exists('404.php')) {
        require '404.php';
    }
}