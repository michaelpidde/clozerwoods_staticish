<?php

$uri = $_SERVER['REQUEST_URI'];
$parts = explode('/', $uri);
array_shift($parts);
$route = implode('/', $parts);

if($route === '') {
    $route = 'home';
}

$file = "{$route}.htm";
if(file_exists($file)) {
    require $file;
    exit();
} else {
    if(file_exists('404.htm')) {
        require '404.htm';
    }
}