<?php
    function createConnection() {
        $servername = "localhost";
        $username = "root";
        $password = "123";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=wither", $username, $password);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            $msg = "Connection failed: " . $e -> getMessage();
            echo "<script>alert('$msg');</script>";
        }

        return $conn;
    }
?>
