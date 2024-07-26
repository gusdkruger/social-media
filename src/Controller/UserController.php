<?php

namespace Wither\Controller;

use Wither\Model\UserModel;
use Wither\Session\Session;
use Wither\View\HttpResponse;

class UserController {

    public static function login(): void {
        if(isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            UserController::validadeEmail($email);
            UserController::validadePassword($password);
            if(UserModel::login($email, $password)) {
                HttpResponse::redirectToFeed();
            }
        }
        HttpResponse::invalidLoginInfo();
    }

    public static function logout(): void {
        new Session();
        $_SESSION["logged"] = false;
        HttpResponse::redirectToLogin();
    }

    public static function signup(): void {
        if(isset($_POST["handle"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {
            $handle = $_POST["handle"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            UserController::validadeHanlde($handle);
            UserController::validadeEmail($email);
            UserController::validadePassword($password);
            if($password === $_POST["password-repeat"]) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                if(UserModel::signup($handle, $email, $passwordHash)) {
                    HttpResponse::redirectToFeed();
                }
            }
            else {
                HttpResponse::passwordsDontMatch();
            }
        }
    }

    private static function validadeHanlde(string $handle): bool {
        if(strlen($handle) >= 3 && strlen($handle) <= 15) {
            return true;
        }
        else {
            HttpResponse::invalidHandle();
        }
    }

    private static function validadeEmail(string $email): bool {
        if(strlen($email) >= 6 && strlen($email) <= 255 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            HttpResponse::invalidEmail();
        }
    }

    private static function validadePassword(string $password): bool {
        if(strlen($password) >= 6 && strlen($password) <= 255) {
            return true;
        }
        else {
            HttpResponse::invalidPassword();
        }
    }
}
