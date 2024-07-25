<?php

include __DIR__ . "/../DatabaseConnection/ConnectionFactory.php";

class PostModel {

    public static function getPostsBetween(int $beginID, int $endID): array {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("SELECT u.handle, p.text, p.created, p.like_count FROM post p JOIN user u ON p.user_id = u.id WHERE p.id BETWEEN :beginID AND :endID ORDER BY p.id DESC;");
            $stmt->bindValue(":beginID", $beginID, PDO::PARAM_INT);
            $stmt->bindValue(":endID", $endID, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ConnectionFactory::closeConnection($conn);
            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            require_once __DIR__ . "/../View/HttpResponse.php";
            HttpResponse::handlePdoException($e);
        }
    }
}
