<?php

class HttpResponse {

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
        echo "Invalid email or password";
        exit();
    }

    public static function invalidHandle(): void {
        http_response_code(400);
        echo "Handle must be between 3 and 15 charachters";
        exit();
    }

    public static function invalidEmail(): void {
        http_response_code(400);
        echo "Email must be between 6 and 255 charachters";
        exit();
    }

    public static function invalidPassword(): void {
        http_response_code(400);
        echo "Password must be between 6 and 255 characters";
        exit();
    }

    public static function passwordsDontMatch(): void {
        http_response_code(400);
        echo "Passwords don't match";
        exit();
    }

    public static function handlePdoException(PDOException $e): void {
        http_response_code(500);
        $code = $e->getCode();
        switch($code) {
            case 0:
                echo "Could not find PDO_MYSQL driver";
                break;
            case 1049:
                echo "Database not found";
                break;
            case "42S02":
                echo "Database table not found";
                break;
            default:
                echo $e->getCode() . "<br><br>" . $e->getMessage();
                break;
        }
        exit();
    }
}
