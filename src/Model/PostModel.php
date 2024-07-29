<?php

namespace Wither\Model;

use Wither\DatabaseConnection\ConnectionFactory;
use Wither\Http\HttpResponse;
use \PDO;
use \PDOException;

class PostModel {

    public static function getLastPostID(): int {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("SELECT MAX(id) FROM post;");
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ConnectionFactory::closeConnection($conn);
            return $stmt->fetch()["MAX(id)"];
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }

    public static function getPosts(int $startID): array {
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("SELECT u.handle, p.text, p.created, p.like_count FROM post p JOIN user u ON p.user_id = u.id WHERE p.id BETWEEN :endID AND :startID ORDER BY p.id DESC;");
            $stmt->bindValue(":endID", $startID - 10, PDO::PARAM_INT);
            $stmt->bindValue(":startID", $startID, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ConnectionFactory::closeConnection($conn);
            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }

    public static function createPost(int $userID, string $text): bool {
        try {
            $conn = ConnectionFactory::createConnection();
            date_default_timezone_set("Brazil/East");
            $created = date("Y-m-d H:i:s", time());
            $stmt = $conn->prepare("INSERT INTO post (user_id, text, created) VALUES (:userID, :text, :created);");
            $stmt->bindValue(":userID", $userID, PDO::PARAM_INT);
            $stmt->bindValue(":text", $text);
            $stmt->bindValue(":created", $created);
            $sucess = $stmt->execute();
            ConnectionFactory::closeConnection($conn);
            return $sucess;
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }
}
