<?php

namespace SocialMedia\View;

use SocialMedia\Http\HttpResponse;
use SocialMedia\DAO\PostDAO;

class View {
    private const HTML_START = __DIR__ . "/html/start.html";
    private const HTML_END = __DIR__ . "/html/end.html";

    private const HTML_LOGIN = __DIR__ . "/html/login.html";
    private const HTML_RECOVER_PASSWORD = __DIR__ . "/html/recoverPassword.html";
    private const HTML_SIGNUP = __DIR__ . "/html/signup.html";
    private const HTML_HEADER = __DIR__ . "/html/header.html";
    private const HTML_FEED = __DIR__ . "/html/feed.html";

    private const HTML_BUTTON_CLOSE_OVERLAY = __DIR__ . "/html/buttonCloseOverlay.html";
    private const HTML_LOAD_MORE_POSTS = __DIR__ . "/html/loadMorePosts.html";
    private const HTML_NO_COMMENTS_YET= __DIR__ . "/html/noCommentsYet.html";
    private const HTML_NO_MORE_POSTS = __DIR__ . "/html/noMorePosts.html";

    private const PHP_POST = __DIR__ . "/html/post.php";
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

    public static function loadPost(array $post): void {
        $body = file_get_contents(self::HTML_START);
        $body .= file_get_contents(self::HTML_HEADER);
        $body .= "<main class='feed'>";
        ob_start();
        require self::PHP_POST;
        $body .= ob_get_clean();
        $body .= "</main>";
        $body .= file_get_contents(self::HTML_END);
        HttpResponse::respond(200, null, $body);
    }

    public static function loadOverlayPost(array $post): void {
        $body = file_get_contents(self::HTML_BUTTON_CLOSE_OVERLAY);
        ob_start();
        require self::PHP_POST;
        $body .= ob_get_clean();
        HttpResponse::respond(200, null, $body);
    }

    public static function loadFeedPosts(array $posts): void {
        $body = "";
        if(count($posts) === 0) {
            $body .= file_get_contents(self::HTML_NO_MORE_POSTS);
        }
        else {
            foreach($posts as $post) {
                ob_start();
                require self::PHP_FEED_POST;
                $body .= ob_get_clean();
            }
            $body .= file_get_contents(self::HTML_LOAD_MORE_POSTS);
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
            $body .= file_get_contents(self::HTML_NO_COMMENTS_YET);
        }
        else {
            foreach($comments as $comment) {
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

    public static function getTemplateRecoverPassword(): void {
        HttpResponse::respond(200, null, file_get_contents(self::HTML_RECOVER_PASSWORD));
    }

    public static function getTemplateSignup(): void {
        HttpResponse::respond(200, null, file_get_contents(self::HTML_SIGNUP));
    }
}
