<?php

namespace Wither\Controller;

use Wither\Http\HttpResponse;
use Wither\Model\PostModel;
use Wither\View\View;

class PostController {

    public static function getPosts(): void {
        if(!$_SESSION["userID"]) {
            HttpResponse::redirectToLogin();
        }
        else {
            $posts = PostModel::getPosts($_SESSION["currentPostID"]);
            $_SESSION["currentPostID"] -= 11;
            View::buildPosts($posts);
        }
    }

    public static function createPost(): void {
        if(!$_SESSION["userID"]) {
            HttpResponse::redirectToLogin();
        }
        else if(isset($_POST["post-text"])) {
            $text = $_POST["post-text"];
            self::validadePostText($text);
            $userID = $_SESSION["userID"];
            if(PostModel::createPost($userID, $text)) {
                $_SESSION["currentPostID"] = PostModel::getLastPostID();
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
