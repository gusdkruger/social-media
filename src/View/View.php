<?php

namespace Wither\View;

use Wither\Model\PostModel;

class View {

    public static function loadHtml(): void {
        readfile(__DIR__ . "/../../public/html/start.html");
        if($_SESSION["userID"]) {
            $_SESSION["currentPostID"] = PostModel::getLastPostID();
            View::readTemplateHeader();
            View::readTemplateFeed();
        }
        else {
            View::readTemplateLogin();
        }
        readfile(__DIR__ . "/../../public/html/end.html");
    }

    public static function buildPosts(array $posts): void {
        if(count($posts) === 0) {
            echo "<h3>No more posts to load</h3>";
            exit();
        }
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
        echo "<h3 class='load-more' hx-post='/loadPosts' hx-trigger='intersect' hx-target='this' hx-swap='outerHTML'>Loading posts</h3>";
        exit();
    }

    public static function readTemplateLogin(): void {
        readfile(__DIR__ . "/../../public/html/login.html");
    }

    public static function readTemplateSignup(): void {
        readfile(__DIR__ . "/../../public/html/signup.html");
    }

    public static function readTemplateHeader(): void {
        readfile(__DIR__ . "/../../public/html/header.html");
    }

    public static function readTemplateFeed(): void {
        readfile(__DIR__ . "/../../public/html/feed.html");
    }
}
