<?php

use Wither\View\View;
use Wither\Controller\UserController;
use Wither\Controller\PostController;

return [
    "GET|/" => [View::class, 'loadHtml'],
    "GET|/feed" => [View::class, 'loadHtml'],
    "GET|/templateLogin" => [View::class, 'readTemplateLogin'],
    "GET|/templateSignup" => [View::class, 'readTemplateSignup'],
    "POST|/login" => [UserController::class, 'login'],
    "POST|/logout" => [UserController::class, 'logout'],
    "POST|/signup" => [UserController::class, 'signup'],
    "POST|/feed" => [PostController::class, 'getPostsBetween'],
    "POST|/createPost" => [PostController::class, 'createPost']
];
