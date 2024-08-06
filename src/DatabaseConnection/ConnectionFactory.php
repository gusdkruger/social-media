<?php

namespace SocialMedia\DatabaseConnection;

use PDO;

class ConnectionFactory {

    public static function createConnection(): PDO {
        $servername = "localhost";
        $databaseName = "social_media";
        $username = "root";
        $password = "";
        return new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
    }

    public static function closeConnection(PDO &$conn): void {
        $conn = null;
    }
}
