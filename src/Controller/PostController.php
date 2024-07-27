<?php

namespace Wither\Controller;

use Wither\Model\PostModel;
use Wither\View\HttpResponse;

class PostController {

    public static function getPosts(): void {
        if(!$_SESSION["logged"]) {
            HttpResponse::redirectToLogin();
        }
        else {
            $feedCurrentID = $_SESSION["currentPostID"];
            $posts = PostModel::getPosts($feedCurrentID);
            // TODO SEND THIS TO VIEW
            foreach($posts as $post) {
                $handle = $post["handle"];
                $text = $post["text"];
                $created = $post["created"];
                $likeCount = $post["like_count"];
                echo "<div class='post'>
                        <div class='post__header'>
                            <h2>@$handle</h2>
                            <h3>$created</h3>
                        </div>
                        <p>$text<p>
                        <div class='post__footer'>
                            <h3>$likeCount</h4>
                            <h2>Comments</h3>
                        </div>
                    </div>";
            }
            exit();
        }
    }

    public static function createPost(): void {
        if(!$_SESSION["logged"]) {
            HttpResponse::redirectToLogin();
        }
        else if(isset($_POST["post-text"])) {
            $text = $_POST["post-text"];
            PostController::validadePostText($text);
            $userID = $_SESSION["userID"];
            if(PostModel::createPost($userID, $text)) {
                $_SESSION["currentPostID"] = PostModel::getLastPostID();
                HttpResponse::redirectToFeed();
            }
        }
    }

    private static function validadePostText(string $text): void {
        if(strlen($text) < 3 && strlen($text) > 255) {
            HttpResponse::invalidPostText();
        }
    }
}
