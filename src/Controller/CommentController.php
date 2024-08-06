<?php

namespace SocialMedia\Controller;

use SocialMedia\DAO\CommentDAO;
use SocialMedia\Http\HttpResponse;
use SocialMedia\View\View;

class CommentController {

    public static function getComments(): void {
        if($_SESSION["userId"] > 0) {
            if(isset($_POST["postId"])) {
                $comments = CommentDAO::getComments($_POST["postId"]);
                View::loadComments($comments);
            }
            else {
                HttpResponse::respond(400, null, null);
            }
        }
        else {
            HttpResponse::redirectToLogin();
        }
    }
}
