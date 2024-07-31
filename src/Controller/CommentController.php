<?php

namespace Wither\Controller;

use Wither\Http\HttpResponse;

class CommentController {

    public static function getComments(): void {
        if(!$_SESSION["userId"]) {
            HttpResponse::redirectToLogin();
        }
        else if(isset($_POST["postId"])) {
            http_response_code(200);
            echo "GET POSTS FOR POST ID:" . $_POST["postId"];
            exit();
        }
        else {
            HttpResponse::respond(400, null, null);
        }
    }
}
