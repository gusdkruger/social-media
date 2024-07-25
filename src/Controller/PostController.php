<?php

include __DIR__ . "/../Model/PostModel.php";
include __DIR__ . "/../View/HttpResponse.php";

class PostController {

    public static function getPostsBetween() {
        $posts = PostModel::getPostsBetween(1, 30);
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

    public static function createPost() {
        if(isset($_POST["post-text"])) {
            $text = $_POST["post-text"];
            PostController::validadePostText($text);
            if(PostModel::createPost(7, $text)) {
                HttpResponse::redirectToFeed();
            }
        }
    }

    private static function validadePostText(string $text): bool {
        if(strlen($text) >= 3 && strlen($text) <= 255) {
            return true;
        }
        else {
            HttpResponse::invalidPostText();
        }
    }
}
