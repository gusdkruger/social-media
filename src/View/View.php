<?php

namespace SocialMedia\View;

use SocialMedia\Http\HttpResponse;
use SocialMedia\DAO\PostDAO;

class View {
    private const HTML_START = __DIR__ . "/html/start.html";
    private const HTML_END = __DIR__ . "/html/end.html";

    private const HTML_LOGIN = __DIR__ . "/html/login.html";
    private const HTML_SIGNUP = __DIR__ . "/html/signup.html";
    private const HTML_HEADER = __DIR__ . "/html/header.html";
    private const HTML_FEED = __DIR__ . "/html/feed.html";

    private const PHP_OVERLAY_POST = __DIR__ . "/html/overlayPost.php";
    private const PHP_FEED_POST = __DIR__ . "/html/feedPost.php";
    private const PHP_COMMENT = __DIR__ . "/html/comment.php";

    public static function loadLogin() {
        if($_SESSION["userId"] > 0) {
            HttpResponse::respond(303, [
                "Location: /feed"
            ], null);
        }
        else {
            $body = file_get_contents(self::HTML_START);
            $body .= file_get_contents(self::HTML_LOGIN);
            $body .= file_get_contents(self::HTML_END);
            HttpResponse::respond(200, null, $body);
        }
    }

    public static function loadFeed() {
        if($_SESSION["userId"] > 0) {
            $bottomPostId = PostDAO::getLastPostId();
            $_SESSION["topPostId"] = $bottomPostId;
            $_SESSION["bottomPostId"] = $bottomPostId;
            $body = file_get_contents(self::HTML_START);
            $body .= file_get_contents(self::HTML_HEADER);
            $body .= file_get_contents(self::HTML_FEED);
            $body .= file_get_contents(self::HTML_END);
            HttpResponse::respond(200, null, $body);
        }
        else {
            HttpResponse::respond(303, [
                "Location: /"
            ], null);
        }
    }

    public static function loadOverlayPost(array $post): void {
        $body = "";
        $id = $post["id"];
        $handle = $post["handle"];
        $text = $post["text"];
        $created = $post["created"];
        $likeCount = $post["like_count"];
        $commentCount = $post["comment_count"];
        ob_start();
        require self::PHP_OVERLAY_POST;
        $body .= ob_get_clean();
        HttpResponse::respond(200, null, $body);
    }

    public static function loadFeedPosts(array $posts): void {
        $body = "";
        if(count($posts) === 0) {
            $body = "<h3>No more posts to load</h3>";
        }
        else {
            foreach($posts as $post) {
                $id = $post["id"];
                $handle = $post["handle"];
                $text = $post["text"];
                $created = $post["created"];
                $likeCount = $post["like_count"];
                $commentCount = $post["comment_count"];
                ob_start();
                require self::PHP_FEED_POST;
                $body .= ob_get_clean();
            }
            $body .= "<h3 class='load-more' hx-post='/getFeedPosts' hx-trigger='intersect' hx-target='this' hx-swap='outerHTML'>Loading posts</h3>";
        }
        HttpResponse::respond(200, null, $body);
    }

    public static function getTemplateCommentsFeed(): void {
        if(isset($_POST["postId"])) {
            $postId = $_POST["postId"];
            ob_start();
            require_once self::PHP_COMMENTS_FEED;
            HttpResponse::respond(200, null, ob_get_clean());
        }
        else {
            HttpResponse::respond(400, null, null);
        }
    }

    public static function loadComments(array $comments): void {
        $body = "";
        if(count($comments) === 0) {
            $body = "<h3>No comment yet</h3>";
        }
        else {
            foreach($comments as $comment) {
                $id = $comment["id"];
                $handle = $comment["handle"];
                $text = $comment["text"];
                $created = $comment["created"];
                $likeCount = $comment["like_count"];
                ob_start();
                require self::PHP_COMMENT;
                $body .= ob_get_clean();
            }
        }
        HttpResponse::respond(200, null, $body);
    }

    public static function getTemplateLogin(): void {
        HttpResponse::respond(200, null, file_get_contents(self::HTML_LOGIN));
    }

    public static function getTemplateSignup(): void {
        HttpResponse::respond(200, null, file_get_contents(self::HTML_SIGNUP));
    }
}
