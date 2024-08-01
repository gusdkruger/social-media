<?php

namespace Wither\Model;

use Wither\DatabaseConnection\ConnectionFactory;
use Wither\Http\HttpResponse;
use \PDO;
use \PDOException;

class CommentModel {

    public static function getComments(int $postId): array {
        
        try {
            $conn = ConnectionFactory::createConnection();
            $stmt = $conn->prepare("SELECT c.id, u.handle, c.text, c.created, c.like_count FROM comment c JOIN user u ON c.user_id = u.id WHERE c.post_id = :postId ORDER BY c.id DESC;");
            $stmt->bindValue(":postId", $postId, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            ConnectionFactory::closeConnection($conn);
            return $stmt->fetchAll();
        }
        catch(PDOException $e) {
            HttpResponse::handlePdoException($e);
        }
    }
}
