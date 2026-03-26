<?php
require_once __DIR__ . '/../app/models/Post.php';
require_once __DIR__ . '/../app/helpers/helpers.php';

$postModel = new Post();
$keyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Pagination settings
$perPage = 5;
$currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Get total posts and calculate total pages
$totalPosts = $postModel->countAll($keyword);
$totalPages = ceil($totalPosts / $perPage);

// Get posts for current page
$posts = $postModel->getPaginated($currentPage, $perPage, $keyword);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Skill Share</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>📘 Student Skill Share</h1>
            <p class="slogan">Nơi sinh viên chia sẻ kiến thức, cùng nhau trưởng thành</p>
        </div>
    </header>

    <div class="container">
        <div class="layout-grid">
            <!-- LEFT MENU -->
            <aside class="sidebar-left">
                <nav class="side-menu">
                    <h4>📌 Menu</h4>
                    <ul>
                        <li><a href="index.php" class="active">🏠 Trang chủ</a></li>
                        <li><a href="create.php">✏️ Viết bài mới</a></li>
                        <li><a href="#" class="coming-soon" data-feature="Danh mục chủ đề">📂 Danh mục</a></li>
                        <li><a href="#" class="coming-soon" data-feature="Bảng xếp hạng">🏆 Nổi bật</a></li>
                        <li><a href="#" class="coming-soon" data-feature="Hồ sơ cá nhân">👤 Hồ sơ</a></li>
                        <li><a href="#" class="coming-soon" data-feature="Thông báo">🔔 Thông báo</a></li>
                    </ul>
                </nav>
            </aside>

            <!-- MAIN CONTENT -->
            <main class="main-content">
                <div class="search-bar">
                    <form method="GET" action="index.php">
                        <input type="text" name="search" placeholder="Tìm kiếm bài viết..." value="<?= escape($keyword) ?>">
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        <a href="create.php" class="btn btn-success">+ Tạo bài viết</a>
                    </form>
                </div>

                <div class="post-list">
                    <?php if (empty($posts)): ?>
                        <div class="empty-state">
                            <p>Chưa có bài viết nào. Hãy tạo bài viết đầu tiên!</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                            <a href="post.php?id=<?= $post['id'] ?>" class="post-card-link">
                                <div class="post-item">
                                    <h3><?= escape($post['title']) ?></h3>
                                    <div class="post-meta">🕐 <?= formatDate($post['created_at']) ?></div>
                                    <div class="post-excerpt"><?= escape(substr($post['content'], 0, 150)) ?>...</div>
                                    <span class="read-more">Đọc tiếp →</span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- PAGINATION -->
                <?php if ($totalPages > 1): ?>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="index.php?page=<?= $currentPage - 1 ?><?= $keyword ? '&search=' . urlencode($keyword) : '' ?>" class="page-btn">← Trước</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="index.php?page=<?= $i ?><?= $keyword ? '&search=' . urlencode($keyword) : '' ?>"
                           class="page-btn <?= $i === $currentPage ? 'active' : '' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="index.php?page=<?= $currentPage + 1 ?><?= $keyword ? '&search=' . urlencode($keyword) : '' ?>" class="page-btn">Tiếp →</a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </main>
        </div>
    </div>

    <!-- Toast notification -->
    <div id="toast" class="toast hidden"></div>

    <script>
        // Show toast notification
        function showToast(message, type = 'info') {
            var toast = document.getElementById('toast');
            toast.textContent = message;
            toast.className = 'toast toast-' + type;
            
            setTimeout(function() {
                toast.classList.add('hidden');
            }, 4000);
        }

        // Check for success/error messages from URL
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('success')) {
            showToast('✅ ' + urlParams.get('success'), 'success');
        }
        if (urlParams.has('error')) {
            showToast('⚠️ ' + urlParams.get('error'), 'error');
        }

        // Coming soon features
        document.querySelectorAll('.coming-soon').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                var feature = this.getAttribute('data-feature');
                showToast('🚧 Tính năng "' + feature + '" đang được phát triển. Hãy quay lại sớm nhé!', 'info');
            });
        });
    </script>
</body>
</html>
