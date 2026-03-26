<?php
require_once __DIR__ . '/../app/models/Post.php';
require_once __DIR__ . '/../app/helpers/helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    
    // Validate input
    if (empty($title)) {
        redirect("create.php?error=" . urlencode("Tiêu đề không được để trống"));
    }
    
    if (empty($content)) {
        redirect("create.php?error=" . urlencode("Nội dung không được để trống"));
    }
    
    if (strlen($title) > 255) {
        redirect("create.php?error=" . urlencode("Tiêu đề quá dài (tối đa 255 ký tự)"));
    }
    
    $postModel = new Post();
    $postModel->create($title, $content);
    redirect("index.php?success=" . urlencode("Tạo bài viết thành công!"));
} else {
    redirect('index.php');
}
