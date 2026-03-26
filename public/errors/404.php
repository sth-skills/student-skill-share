<?php
require_once __DIR__ . '/../app/helpers/helpers.php';
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📘 Student Skill Share</h1>
        </div>
    </header>

    <div class="container">
        <div class="error-page">
            <div class="error-icon">🔍</div>
            <h2>404 - Không tìm thấy trang</h2>
            <p>Xin lỗi, trang bạn đang tìm kiếm không tồn tại hoặc đã bị xóa.</p>
            <div class="error-actions">
                <a href="../index.php" class="btn btn-primary">🏠 Về trang chủ</a>
                <a href="../create.php" class="btn btn-success">✏️ Tạo bài viết mới</a>
            </div>
        </div>
    </div>
</body>
</html>
