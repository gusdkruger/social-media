<?php

spl_autoload_register(function (string $className) {
    $path = str_replace("Wither", "src", $className) . ".php";
    $path = __DIR__ . "\..\\" . $path;
    $path = str_replace("\\", DIRECTORY_SEPARATOR, $path);
    if(file_exists($path)) {
        require_once $path;
    }
});

$routes = require_once __DIR__ . "/../config/routes.php";

$pathInfo = $_SERVER["PATH_INFO"] ?? "/";
$httpMethod = $_SERVER["REQUEST_METHOD"];
$key = "$httpMethod|$pathInfo";

if(array_key_exists($key, $routes)) {
    $staticFunction = $routes[$key];
    if(is_callable($staticFunction)) {
        call_user_func($staticFunction);
    }
    else {
        http_response_code(500);
        echo "500 INTERNAL SERVER ERROR<br>Invalid callback: " . $staticFunction;
    }
}
else {
    http_response_code(404);
    echo "404 NOT FOUND<br>key: $key<br>PATH: " . $_SERVER["PATH_INFO"] . "<br>METHOD: " . $_SERVER["REQUEST_METHOD"];
}
