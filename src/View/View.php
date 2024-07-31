<?php

namespace Wither\View;

use Wither\Http\HttpResponse;
use Wither\Model\PostModel;

class View {
    private const PATH_TO_HTML_FOLDER = __DIR__ . "/../../public/html/";

    private const HTML_START = self::PATH_TO_HTML_FOLDER . "start.html";
    private const HTML_END = self::PATH_TO_HTML_FOLDER . "end.html";

    private const HTML_LOGIN = self::PATH_TO_HTML_FOLDER . "login.html";
    private const HTML_SIGNUP = self::PATH_TO_HTML_FOLDER . "signup.html";
    private const HTML_HEADER = self::PATH_TO_HTML_FOLDER . "header.html";
    private const HTML_FEED = self::PATH_TO_HTML_FOLDER . "feed.html";

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
            $bottomPostId = PostModel::getLastPostId();
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

    public static function loadPosts(array $posts): void {
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
                $body .= "
                <div class='post'>
                    <div class='post__header'>
                        <h2>@$handle | post_id: $id</h2>
                        <h3>$created</h3>
                    </div>
                    <p>$text<p>
                    <div class='post__footer'>
                        <h2>$likeCount</h2>
                        <h3 hx-post='/loadComments' hx-vals='{\"postId\": \"$id\"}' hx-trigger='click'>Comments</h3>
                    </div>
                </div>";
            }
            $body .= "<h3 class='load-more' hx-post='/loadPosts' hx-trigger='intersect' hx-target='this' hx-swap='outerHTML'>Loading posts</h3>";
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
