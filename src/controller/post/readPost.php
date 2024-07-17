<?php
    include __DIR__ . "/../../model/postModel.php";

    $posts = PostModel::readPosts(1, 30);
    foreach($posts as $post) {
        $handle = $post["handle"];
        $text = $post["text"];
        $created = $post["created"];
        $likeCount = $post["like_count"];
        echo "Handle: $handle<br>Created: $created<br>Likes: $likeCount<br>Text: $text <br><br>";
    }
?>
