<?php

include __DIR__ . "/../Model/PostModel.php";

class PostController {

    public static function getPostsBetween() {
        $posts = PostModel::getPostsBetween(1, 30);
        foreach($posts as $post) {
            $handle = $post["handle"];
            $text = $post["text"];
            $created = $post["created"];
            $likeCount = $post["like_count"];
            echo "<div><h2>$handle</h2><h3>$created</h3><h4>$likeCount</h4><p>$text<p></div>";
        }
        exit();
    }
}
