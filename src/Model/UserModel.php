<?php

namespace Wither\Model;

use Wither\DatabaseConnection\ConnectionFactory;
use Wither\Session\Session;
use Wither\View\HttpResponse;
use \PDO;

class UserModel {

    public static function login(string $email, string $password): bool {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("SELECT password FROM user WHERE email = :email;");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            new Session();
            $_SESSION["logged"] = $result && password_verify($password, $result["password"]);
            ConnectionFactory::closeConnection($conn);
            return $_SESSION["logged"];
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }

    public static function signup(string $handle, string $email, string $passwordHash): bool {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("INSERT INTO user (handle, email, password) VALUES (:handle, :email, :passwordHash);");
            $stmt->bindValue(":handle", $handle);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":passwordHash", $passwordHash);
            new Session();
            $_SESSION["logged"] = $stmt->execute();
            ConnectionFactory::closeConnection($conn);
            return $_SESSION["logged"];
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }
}
