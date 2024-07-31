<?php

namespace Wither\Controller;

use Wither\Http\HttpResponse;
use Wither\Model\PostModel;
use Wither\View\View;

class PostController {

    public static function getPosts(): void {
        if(!$_SESSION["userId"]) {
            HttpResponse::redirectToLogin();
        }
        else {
            $posts = PostModel::getPosts($_SESSION["bottomPostId"]);
            $_SESSION["bottomPostId"] -= 11;
            View::loadPosts($posts);
        }
    }

    public static function createPost(): void {
        if(!$_SESSION["userId"]) {
            HttpResponse::redirectToLogin();
        }
        else if(isset($_POST["post-text"])) {
            $text = $_POST["post-text"];
            self::validadePostText($text);
            if(PostModel::createPost($_SESSION["userId"], $text)) {
                HttpResponse::redirectToFeed();
            }
        }
        else {
            HttpResponse::respond(400, null, null);
        }
    }

    private static function validadePostText(string $text): void {
        if(strlen($text) < 3 || strlen($text) > 255) {
            HttpResponse::invalidPostText();
        }
    }
}
