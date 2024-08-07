<?php

return [
    "GET|/" => [\SocialMedia\View\View::class, "loadLogin"],
    "GET|/feed" => [\SocialMedia\View\View::class, "loadFeed"],
    "GET|/templateLogin" => [\SocialMedia\View\View::class, "getTemplateLogin"],
    "GET|/templateSignup" => [\SocialMedia\View\View::class, "getTemplateSignup"],
    "GET|/post" => [\SocialMedia\Controller\PostController::class, "getPostFromUrl"],
    "POST|/login" => [\SocialMedia\Controller\UserController::class, "login"],
    "POST|/logout" => [\SocialMedia\Controller\UserController::class, "logout"],
    "POST|/signup" => [\SocialMedia\Controller\UserController::class, "signup"],
    "POST|/getFeedPosts" => [\SocialMedia\Controller\PostController::class, "getFeedPosts"],
    "POST|/getPost" => [\SocialMedia\Controller\PostController::class, "getPostFromPost"],
    "POST|/createPost" => [\SocialMedia\Controller\PostController::class, "createPost"],
    "POST|/getComments" => [\SocialMedia\Controller\CommentController::class, "getComments"]
];
