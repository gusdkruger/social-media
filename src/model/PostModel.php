<?php
    include __DIR__ . "/../connection/connection.php";

    class PostModel {

        public static function readPosts($beginID, $endID) {
            $conn = DatabaseConnection::connect();
            $stmt = $conn->prepare("SELECT u.handle, p.text, p.created, p.like_count FROM post p JOIN user u ON p.user_id = u.id WHERE p.id BETWEEN $beginID AND $endID ORDER BY p.id DESC;");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            return $stmt->fetchAll();
            DatabaseConnection::closeConnection($conn);
        }
    }
?>
