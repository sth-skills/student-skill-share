<?php
require_once __DIR__ . '/../app/helpers/helpers.php';

$errorMessage = isset($_GET['msg']) ? escape($_GET['msg']) : 'Đã xảy ra lỗi không xác định.';
$errorCode = isset($_GET['code']) ? escape($_GET['code']) : '500';

http_response_code((int)$errorCode);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lỗi - Student Skill Share</title>
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
            <div class="error-icon">⚠️</div>
            <h2>Oops! Có lỗi xảy ra</h2>
            <p class="error-message"><?= $errorMessage ?></p>
            <div class="error-actions">
                <a href="../index.php" class="btn btn-primary">🏠 Về trang chủ</a>
                <a href="javascript:history.back()" class="btn btn-secondary">← Quay lại</a>
            </div>
        </div>
    </div>
</body>
</html>
