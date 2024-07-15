<?php
    class DatabaseConnection {

        public static function connect() {
            $servername = "localhost";
            $username = "root";
            $password = "";
            try {
                $conn = new PDO("mysql:host=$servername;dbname=wither", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            return $conn;
        }

        public static function closeConnection($conn) {
            $conn = null;
        }
    }
?>
