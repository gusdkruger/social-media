<?php

include __DIR__ . "/../DatabaseConnection/ConnectionFactory.php";
include __DIR__ . "/../Session/Session.php";

class UserModel {

    public static function login(string $email, string $password): bool {
        $conn = ConnectionFactory::createConnection();
        $stmt = $conn->prepare("SELECT password FROM user WHERE email = :email;");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        new Session();
        if($result && password_verify($password, $result["password"])) {
            $_SESSION["logged"] = true;
        }
        else {
            // WILL ONLY EVER RUN IF USER IS ALREADY LOGGED AND SENDS ANOTHER LOGIN ATTEMPT WITH A INVALID EMAILS OR PASSWORDS
            $_SESSION["logged"] = false;
        }
        ConnectionFactory::closeConnection($conn);
        return $_SESSION["logged"];
    }

    // TO DO: RETURN AND PARAMETERS TYPE
    public static function register($handle, $email, $passwordHash) {
        $conn = ConnectionFactory::createConnection();
        $stmt = $conn->prepare("INSERT INTO user (handle, email, password) VALUES (:handle, :email, :passwordHash);");
        $stmt->bindValue(":handle", $handle);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":passwordHash", $passwordHash);
        $stmt->execute();
        new Session();
        $_SESSION["logged"] = true;
        ConnectionFactory::closeConnection($conn);
    }
}
