<?php

include __DIR__ . "/../Model/UserModel.php";

class UserController {

    public static function login() {
        if(isset($_POST["email"]) && isset($_POST["password"])) {
            $email = $_POST["email"];
            $password = $_POST["password"];
            // VALIDATE EMAIL AND PASSWORD BEFORE CALLING UserModel::login()
            if(UserModel::login($email, $password)) {
                header("HX-Redirect: /feed");
                exit();
            }
            else {
                http_response_code(401);
                echo "<p class='error-message'>Invalid email or password</p>";
                exit();
            }
        }
    }

    public static function logout() {
        require_once __DIR__ . "/../Session/Session.php";
        new Session();
        $_SESSION["logged"] = false;
        header("HX-Redirect: /");
        exit();
    }

    public static function signup() {
        if(isset($_POST["handle"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["password-repeat"])) {
            $handle = $_POST["handle"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            // VALIDATE HANDLE, EMAIL
            if($password === $_POST["password-repeat"]) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                UserModel::register($handle, $email, $passwordHash);
                header("HX-Redirect: /feed");
                exit();
            }
            else {
                http_response_code(400);
                echo "<p class='error-message'>Passwords don't match</p>";
                exit();
            }
        }
    }
}
