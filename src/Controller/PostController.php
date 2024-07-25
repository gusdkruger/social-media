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
