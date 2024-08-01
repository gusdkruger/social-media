<?php

namespace Wither\Controller;

use Wither\Http\HttpResponse;
use Wither\Model\CommentModel;
use Wither\View\View;

class CommentController {

    public static function getComments(): void {
        if(!$_SESSION["userId"]) {
            HttpResponse::redirectToLogin();
        }
        else if(isset($_POST["postId"])) {
            $comments = CommentModel::getComments($_POST["postId"]);
            View::loadComments($comments);
        }
        else {
            HttpResponse::respond(400, null, null);
        }
    }
}
