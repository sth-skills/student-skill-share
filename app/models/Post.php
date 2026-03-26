<?php
require_once __DIR__ . '/../config/database.php';

class Post {
    private $pdo;
    
    public function __construct() {
        $this->pdo = getConnection();
    }
    
    // Get all posts
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    // Get posts with pagination
    public function getPaginated($page = 1, $perPage = 5, $keyword = '') {
        $offset = ($page - 1) * $perPage;
        
        if ($keyword) {
            $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE title LIKE :keyword ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            $stmt->bindValue(':limit', (int)$perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $this->pdo->prepare("SELECT * FROM posts ORDER BY created_at DESC LIMIT :limit OFFSET :offset");
            $stmt->bindValue(':limit', (int)$perPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            $stmt->execute();
        }
        
        return $stmt->fetchAll();
    }

    // Count total posts
    public function countAll($keyword = '') {
        if ($keyword) {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM posts WHERE title LIKE ?");
            $stmt->execute(['%' . $keyword . '%']);
        } else {
            $stmt = $this->pdo->query("SELECT COUNT(*) FROM posts");
        }
        return (int)$stmt->fetchColumn();
    }

    // Get suggested posts (exclude current)
    public function getSuggested($excludeId, $limit = 5) {
        $stmt = $this->pdo->prepare("SELECT id, title, created_at FROM posts WHERE id != :excludeId ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':excludeId', (int)$excludeId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Search posts by title
    public function search($keyword) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE title LIKE ? ORDER BY created_at DESC");
        $stmt->execute(['%' . $keyword . '%']);
        return $stmt->fetchAll();
    }
    
    // Get single post by ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    // Create new post
    public function create($title, $content) {
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
        return $stmt->execute([$title, $content]);
    }
}
