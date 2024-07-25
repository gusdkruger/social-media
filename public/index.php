<?php

if(!array_key_exists('PATH_INFO', $_SERVER) || $_SERVER["PATH_INFO"] === "/") {
    require_once __DIR__ . "/../src/View/View.php";
    View::loadHtml();
}
else if($_SERVER["PATH_INFO"] === "/teamplateLogin" && $_SERVER["REQUEST_METHOD"] === "GET") {
    require_once __DIR__ . "/../src/View/View.php";
    View::readTeamplateLogin();
}
else if($_SERVER["PATH_INFO"] === "/login" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/../src/Controller/UserController.php";
    UserController::login();
}
else if($_SERVER["PATH_INFO"] === "/logout" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/../src/Controller/UserController.php";
    UserController::logout();
}
else if($_SERVER["PATH_INFO"] === "/teamplateSignup" && $_SERVER["REQUEST_METHOD"] === "GET") {
    require_once __DIR__ . "/../src/View/View.php";
    View::readTeamplateSignup();
}
else if($_SERVER["PATH_INFO"] === "/signup" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/../src/Controller/UserController.php";
    UserController::signup();
}
else if($_SERVER["PATH_INFO"] === "/feed" && $_SERVER["REQUEST_METHOD"] === "GET") {
    require_once __DIR__ . "/../src/View/View.php";
    View::loadHtml();
}
else if($_SERVER["PATH_INFO"] === "/feed" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/../src/Controller/PostController.php";
    PostController::getPostsBetween();
}
else if($_SERVER["PATH_INFO"] === "/createPost" && $_SERVER["REQUEST_METHOD"] === "POST") {
    require_once __DIR__ . "/../src/Controller/PostController.php";
    PostController::createPost();
}
else {
    http_response_code(404);
    echo "404 NOT FOUND<br>PATH: " . $_SERVER["PATH_INFO"] . "<br>METHOD: " . $_SERVER["REQUEST_METHOD"];
}
