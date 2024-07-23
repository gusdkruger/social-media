<?php

class ConnectionFactory {

    public static function createConnection(): PDO {
        $servername = "localhost";
        $username = "root";
        $password = "";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=wither", $username, $password);
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            exit();
        }
        return $conn;
    }

    public static function closeConnection(&$conn): void {
        $conn = null;
    }
}
