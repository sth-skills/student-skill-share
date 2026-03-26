<?php
require_once __DIR__ . '/../config/database.php';

class Comment {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getConnection();
    }
    
    // Get comments by post ID
    public function getByPostId($postId) {
        $stmt = $this->pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }
    
    // Create new comment
    public function create($postId, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO comments (post_id, content) VALUES (?, ?)");
        return $stmt->execute([$postId, $content]);
    }
}
