<?php
require_once __DIR__ . '/../app/models/Post.php';
require_once __DIR__ . '/../app/models/Comment.php';
require_once __DIR__ . '/../app/helpers/helpers.php';

$postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Validate post ID
if ($postId <= 0) {
    header("Location: index.php");
    exit();
}

$postModel = new Post();
$commentModel = new Comment();

$post = $postModel->getById($postId);

// Check if post exists
if (!$post) {
    header("Location: index.php");
    exit();
}

$comments = $commentModel->getByPostId($postId);
$suggested = $postModel->getSuggested($postId, 6);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escape($post['title']) ?> – Student Skill Share</title>
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
        <div class="layout-grid layout-grid--detail">
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
                <div class="post-detail">
                    <h2><?= escape($post['title']) ?></h2>
                    <div class="post-meta">🕐 <?= formatDate($post['created_at']) ?></div>
                    <div class="post-content"><?= nl2br(escape($post['content'])) ?></div>
                </div>

                <div class="comments-section">
                    <h3>💬 Bình luận (<?= count($comments) ?>)</h3>

                    <?php if (empty($comments)): ?>
                        <div class="empty-state"><p>Chưa có bình luận nào. Hãy là người đầu tiên!</p></div>
                    <?php else: ?>
                        <?php foreach ($comments as $comment): ?>
                            <div class="comment-item">
                                <div class="comment-content"><?= nl2br(escape($comment['content'])) ?></div>
                                <div class="comment-meta"><?= formatDate($comment['created_at']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="comment-form">
                        <h4>Thêm bình luận</h4>
                        <form method="POST" action="comment.php">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <div class="form-group">
                                <textarea name="content" placeholder="Viết bình luận của bạn..." required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi bình luận</button>
                        </form>
                    </div>
                </div>
            </main>

            <!-- RIGHT SIDEBAR: suggested posts -->
            <aside class="sidebar-right">
                <div class="suggested-posts">
                    <h4>📖 Bài viết tiếp theo</h4>
                    <?php if (empty($suggested)): ?>
                        <p class="no-suggest">Chưa có bài viết nào khác.</p>
                    <?php else: ?>
                        <ul>
                            <?php foreach ($suggested as $s): ?>
                                <li>
                                    <a href="post.php?id=<?= $s['id'] ?>"><?= escape($s['title']) ?></a>
                                    <span class="suggest-date"><?= formatDate($s['created_at']) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </aside>
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
