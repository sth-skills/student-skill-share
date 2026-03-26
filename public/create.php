<?php
require_once __DIR__ . '/../app/helpers/helpers.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài viết mới</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📘 Student Skill Share</h1>
        </div>
    </header>

    <div class="container">
        <a href="index.php" class="back-link">← Quay lại trang chủ</a>
        
        <div class="create-form">
            <h2>Tạo bài viết mới</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-error">
                    ⚠️ <?= escape($_GET['error']) ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="store.php">
                <div class="form-group">
                    <label for="title">Tiêu đề: <span class="required">*</span></label>
                    <input type="text" id="title" name="title" maxlength="255" required 
                           value="<?= isset($_GET['title']) ? escape($_GET['title']) : '' ?>">
                    <small>Tối đa 255 ký tự</small>
                </div>
                
                <div class="form-group">
                    <label for="content">Nội dung: <span class="required">*</span></label>
                    <textarea id="content" name="content" rows="10" required><?= isset($_GET['content']) ? escape($_GET['content']) : '' ?></textarea>
                    <small>Chia sẻ kinh nghiệm, kiến thức của bạn</small>
                </div>
                
                <button type="submit" class="btn btn-success">Đăng bài</button>
            </form>
        </div>
    </div>
</body>
</html>
