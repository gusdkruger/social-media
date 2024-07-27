<?php

namespace Wither\View;

class HttpResponse {
    private const START_ERROR_MESSAGE = "<p class='error-message'>";
    private const END_ERROR_MESSAGE = "</p>";

    public static function redirectToLogin(): void {
        http_response_code(303);
        header("HX-Redirect: /");
        exit();
    }

    public static function redirectToFeed(): void {
        http_response_code(303);
        header("HX-Redirect: /feed");
        exit();
    }

    public static function invalidLoginInfo(): void {
        http_response_code(401);
        echo self::START_ERROR_MESSAGE . "Invalid email or password" . self::END_ERROR_MESSAGE;
        exit();
    }

    public static function invalidHandle(): void {
        http_response_code(400);
        echo self::START_ERROR_MESSAGE . "Handle must be between 3 and 15 charachters" . self::END_ERROR_MESSAGE;
        exit();
    }

    public static function invalidEmail(): void {
        http_response_code(400);
        echo self::START_ERROR_MESSAGE . "Email must be between 6 and 255 charachters" . self::END_ERROR_MESSAGE;
        exit();
    }

    public static function invalidPassword(): void {
        http_response_code(400);
        echo self::START_ERROR_MESSAGE . "Password must be between 6 and 255 characters" . self::END_ERROR_MESSAGE;
        exit();
    }

    public static function passwordsDontMatch(): void {
        http_response_code(400);
        echo self::START_ERROR_MESSAGE . "Passwords don't match" . self::END_ERROR_MESSAGE;
        exit();
    }

    public static function invalidPostText(): void  {
        http_response_code(400);
        echo self::START_ERROR_MESSAGE . "Post text must be between 3 and 255 charachters" . self::END_ERROR_MESSAGE;
        exit();
    }

    public static function handlePdoException(PDOException $e): void {
        http_response_code(500);
        $code = $e->getCode();
        switch($code) {
            case 0:
                echo self::START_ERROR_MESSAGE . "Could not find PDO_MYSQL driver" . self::END_ERROR_MESSAGE;
                break;
            case 1049:
                echo self::START_ERROR_MESSAGE . "Database not found" . self::END_ERROR_MESSAGE;
                break;
            case "42S02":
                echo self::START_ERROR_MESSAGE . "Database table not found" . self::END_ERROR_MESSAGE;
                break;
            default:
                echo $e->getCode() . "<br><br>" . $e->getMessage();
                break;
        }
        exit();
    }
}
