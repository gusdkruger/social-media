<?php

class ConnectionFactory {

    public static function createConnection(): PDO {
        $servername = "localhost";
        $username = "root";
        $password = "";
        return new PDO("mysql:host=$servername;dbname=wither", $username, $password);
    }

    public static function closeConnection(PDO &$conn): void {
        $conn = null;
    }
}
