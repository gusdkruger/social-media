<?php

namespace Wither\Controller;

use Wither\Http\HttpResponse;
use Wither\Model\PostModel;
use Wither\Model\UserModel;

class UserController {

    public static function login(): void {
        if(isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            self::validadeEmail($email);
            self::validadePassword($password);
            $userID = UserModel::login($email, $password);
            if($userID > 0) {
                $_SESSION["userId"] = $userID;
                HttpResponse::redirectToFeed();
            }
            else {
                HttpResponse::invalidLoginInfo();
            }
        }
        else {
            HttpResponse::respond(400, null, null);
        }
    }

    public static function logout(): void {
        $_SESSION["userId"] = null;
        $_SESSION["bottomPostId"] = null;
        HttpResponse::redirectToLogin();
    }

    // TODO RETURN ERROR MESSAGE WHEN HANDLE OR EMAIL IS ALREADY BEING USED
    public static function signup(): void {
        if(isset($_POST["handle"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {
            $handle = $_POST["handle"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            self::validadeHanlde($handle);
            self::validadeEmail($email);
            self::validadePassword($password);
            if($password === $_POST["password-repeat"]) {
                $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
                $id = UserModel::signup($handle, $email, $passwordHash);
                if($id > 0) {
                    $_SESSION["userId"] = $id;
                    HttpResponse::redirectToFeed();
                }
            }
            else {
                HttpResponse::passwordsDontMatch();
            }
        }
        else {
            HttpResponse::respond(400, null, null);
        }
    }

    private static function validadeHanlde(string $handle): void {
        if(strlen($handle) < 3 || strlen($handle) > 15) {
            HttpResponse::invalidHandle();
        }
    }

    private static function validadeEmail(string $email): void {
        if(strlen($email) < 6 || strlen($email) > 255 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            HttpResponse::invalidEmail();
        }
    }

    private static function validadePassword(string $password): void {
        if(strlen($password) < 6 || strlen($password) > 255) {
            HttpResponse::invalidPassword();
        }
    }
}
