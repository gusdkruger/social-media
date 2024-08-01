<?php

return [
    "GET|/" => [\Wither\View\View::class, 'loadLogin'],
    "GET|/feed" => [\Wither\View\View::class, 'loadFeed'],
    "GET|/templateLogin" => [\Wither\View\View::class, 'getTemplateLogin'],
    "GET|/templateSignup" => [\Wither\View\View::class, 'getTemplateSignup'],
    "POST|/templateCommentsFeed" => [\Wither\View\View::class, 'getTemplateCommentsFeed'],
    "POST|/login" => [\Wither\Controller\UserController::class, 'login'],
    "POST|/logout" => [\Wither\Controller\UserController::class, 'logout'],
    "POST|/signup" => [\Wither\Controller\UserController::class, 'signup'],
    "POST|/getPosts" => [\Wither\Controller\PostController::class, 'getPosts'],
    "POST|/createPost" => [\Wither\Controller\PostController::class, 'createPost'],
    "POST|/getComments" => [\Wither\Controller\CommentController::class, 'getComments']
];
