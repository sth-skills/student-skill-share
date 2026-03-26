<?php
require_once __DIR__ . '/../app/models/Comment.php';
require_once __DIR__ . '/../app/helpers/helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
    $content = trim($_POST['content'] ?? '');
    
    // Validate input
    if ($postId <= 0) {
        redirect('index.php');
    }
    
    if (empty($content)) {
        redirect("post.php?id=$postId&error=" . urlencode("Nội dung bình luận không được để trống"));
    }
    
    if (strlen($content) > 1000) {
        redirect("post.php?id=$postId&error=" . urlencode("Bình luận quá dài (tối đa 1000 ký tự)"));
    }
    
    $commentModel = new Comment();
    $commentModel->create($postId, $content);
    redirect("post.php?id=$postId&success=" . urlencode("Thêm bình luận thành công!"));
} else {
    redirect('index.php');
}
