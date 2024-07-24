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
        $code = $e->getCode();
            switch($code) {
                case 0:
                    http_response_code(500);
                    echo "Could not find PDO_MYSQL driver";
                    exit();
                    break;
                case 1049:
                    http_response_code(500);
                    echo "Database not found";
                    exit();
                    break;
                case "42S02":
                    http_response_code(500);
                    echo "Database table not found";
                    exit();
                    break;
                default:
                    http_response_code(500);
                    echo $e->getCode() . "<br><br>" . $e->getMessage();
                    break;
            }
        exit();
    }
}
