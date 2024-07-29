<?php

namespace Wither\Model;

use Wither\DatabaseConnection\ConnectionFactory;
use Wither\Http\HttpResponse;
use \PDO;
use \PDOException;

class UserModel {

    public static function login(string $email, string $password): int {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("SELECT id, password FROM user WHERE email = :email;");
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ConnectionFactory::closeConnection($conn);
            if(password_verify($password, $result["password"] ?? "")) {
                return $result["id"];
            }
            else {
                return 0;
            }
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }

    public static function signup(string $handle, string $email, string $passwordHash): int {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("INSERT INTO user (handle, email, password) VALUES (:handle, :email, :passwordHash);");
            $stmt->bindValue(":handle", $handle);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(":passwordHash", $passwordHash);
            $stmt->execute();
            $id = $conn->lastInsertId() ?? 0;
            ConnectionFactory::closeConnection($conn);
            return $id;
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }
}
