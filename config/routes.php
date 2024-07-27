<?php

return [
    "GET|/" => [\Wither\View\View::class, 'loadHtml'],
    "GET|/feed" => [\Wither\View\View::class, 'loadHtml'],
    "GET|/templateLogin" => [\Wither\View\View::class, 'readTemplateLogin'],
    "GET|/templateSignup" => [\Wither\View\View::class, 'readTemplateSignup'],
    "POST|/login" => [\Wither\Controller\UserController::class, 'login'],
    "POST|/logout" => [\Wither\Controller\UserController::class, 'logout'],
    "POST|/signup" => [\Wither\Controller\UserController::class, 'signup'],
    "POST|/loadPosts" => [\Wither\Controller\PostController::class, 'getPosts'],
    "POST|/createPost" => [\Wither\Controller\PostController::class, 'createPost']
];
