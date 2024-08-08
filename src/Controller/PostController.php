<?php

namespace SocialMedia\Controller;

use SocialMedia\DAO\PostDAO;
use SocialMedia\Http\HttpResponse;
use SocialMedia\View\View;

class PostController {

    public static function getPostFromUrl(): void {
        if($_SESSION["userId"] > 0) {
            if(isset($_GET["id"])) {
                $post = PostDAO::getPost($_GET["id"]);
                View::loadPost($post);
            }
            else {
                HttpResponse::respond(400, null, null);
            }
        }
        else {
            HttpResponse::respond(303, [
                "Location: /"
            ], null);
        }
    }

    public static function getPostFromPost(): void {
        if($_SESSION["userId"] > 0) {
            if(isset($_POST["id"])) {
                $post = PostDAO::getPost($_POST["id"]);
                View::loadOverlayPost($post);
            }
            else {
                HttpResponse::respond(400, null, null);
            }
        }
        else {
            HttpResponse::redirectToLogin();
        }
    }

    public static function getFeedPosts(): void {
        if($_SESSION["userId"] > 0) {
            $posts = PostDAO::getFeedPosts($_SESSION["bottomPostId"]);
            $_SESSION["bottomPostId"] -= 11;
            View::loadFeedPosts($posts);
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
