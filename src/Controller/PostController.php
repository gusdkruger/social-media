<?php

namespace SocialMedia\Controller;

use SocialMedia\DAO\PostDAO;
use SocialMedia\Http\HttpResponse;
use SocialMedia\View\View;

class PostController {

    public static function getPosts(): void {
        if($_SESSION["userId"] > 0) {
            $posts = PostDAO::getPosts($_SESSION["bottomPostId"]);
            $_SESSION["bottomPostId"] -= 11;
            View::loadPosts($posts);
        }
        else {
            HttpResponse::redirectToLogin();
        }
    }

    public static function createPost(): void {
        if($_SESSION["userId"] > 0) {
            if(isset($_POST["post-text"])) {
                $text = $_POST["post-text"];
                self::validadePostText($text);
                if(PostDAO::createPost($_SESSION["userId"], $text)) {
                    HttpResponse::redirectToFeed();
                }
            }
            else {
                HttpResponse::respond(400, null, null);
            }
        }
        else {
            HttpResponse::redirectToLogin();
        }
    }

    private static function validadePostText(string $text): void {
        if(strlen($text) < 3 || strlen($text) > 255) {
            HttpResponse::invalidPostText();
        }
    }
}
