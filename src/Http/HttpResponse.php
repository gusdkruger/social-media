<?php

namespace SocialMedia\Http;

use \PDOException;

class HttpResponse {
    private const START_MSG = "<p class='error-message'>";
    private const END_MSG = "</p>";

    public static function respond(int $code, ?array $header = null, ?string $body = null): void {
        http_response_code($code);
        if($header) {
            foreach ($header as $value) {
                header($value);
            }
        }
        if($body) {
            echo $body;
        }
        exit();
    }

    public static function redirectToLogin(): void {
        self::respond(303, ["HX-Redirect: /"], null);
    }

    public static function redirectToFeed(): void {
        self::respond(303, ["HX-Redirect: /feed"], null);
    }

    public static function invalidLoginInfo(): void {
        $body = self::START_MSG . "Invalid email or password" . self::END_MSG;
        self::respond(401, null, $body);
    }

    public static function invalidHandle(): void {
        $body = self::START_MSG . "Handle must be between 3 and 15 characters" . self::END_MSG;
        self::respond(400, null, $body);
    }

    public static function invalidEmail(): void {
        $body = self::START_MSG . "Email must be between 6 and 255 characters" . self::END_MSG;
        self::respond(400, null, $body);
    }

    public static function invalidPassword(): void {
        $body = self::START_MSG . "Password must be between 6 and 255 characters" . self::END_MSG;
        self::respond(400, null, $body);
    }

    public static function passwordsDontMatch(): void {
        $body = self::START_MSG . "Passwords don't match" . self::END_MSG;
        self::respond(400, null, $body);
    }

    public static function invalidPostText(): void  {
        $body = self::START_MSG . "Post text must be between 3 and 255 characters" . self::END_MSG;
        self::respond(400, null, $body);
    }

    public static function handlePdoException(PDOException $e): void {
        $body = "";
        switch($e->getCode()) {
            case 0:
                $body .= self::START_MSG . "Could not find PDO_MYSQL driver" . self::END_MSG;
                break;
            case 1049:
                $body .= self::START_MSG . "Database not found" . self::END_MSG;
                break;
            case "42S02":
                $body .= self::START_MSG . "Database table not found" . self::END_MSG;
                break;
            default:
            $body .= $e->getCode() . "<br><br>" . $e->getMessage();
                break;
        }
        exit();
        self::respond(500, null, $body);
    }
}
