<?php

return [
    "GET|/" => [\SocialMedia\View\View::class, "loadLogin"],
    "GET|/feed" => [\SocialMedia\View\View::class, "loadFeed"],
    "GET|/templateLogin" => [\SocialMedia\View\View::class, "getTemplateLogin"],
    "GET|/templateSignup" => [\SocialMedia\View\View::class, "getTemplateSignup"],
    //"POST|/templateCommentsFeed" => [\SocialMedia\View\View::class, "getTemplateCommentsFeed"],
    "POST|/login" => [\SocialMedia\Controller\UserController::class, "login"],
    "POST|/logout" => [\SocialMedia\Controller\UserController::class, "logout"],
    "POST|/signup" => [\SocialMedia\Controller\UserController::class, "signup"],
    "POST|/getPosts" => [\SocialMedia\Controller\PostController::class, "getPosts"],
    "POST|/createPost" => [\SocialMedia\Controller\PostController::class, "createPost"],
    //"POST|/getComments" => [\SocialMedia\Controller\CommentController::class, "getComments"]
];
