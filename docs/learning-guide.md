# 📚 Hướng dẫn học LAMP Stack qua Project Student Skill Share

## 🎯 Mục tiêu

Tài liệu này giúp người mới học hiểu rõ cấu trúc project và biết nên học theo thứ tự nào.

---

## 📊 Phân loại Files

### ⭐ CORE Files (Bắt buộc phải hiểu)

Đây là các file chứa logic chính của ứng dụng. Bạn PHẢI hiểu những file này:

1. **Database & Models**
   - `database.sql` - Cấu trúc database
   - `app/config/database.php` - Kết nối database
   - `app/models/Post.php` - CRUD operations cho Post
   - `app/models/Comment.php` - CRUD operations cho Comment

2. **Views & Controllers (Combined)**
   - `public/index.php` - Hiển thị danh sách bài viết
   - `public/create.php` - Form tạo bài viết
   - `public/store.php` - Xử lý lưu bài viết
   - `public/post.php` - Hiển thị chi tiết bài viết
   - `public/comment.php` - Xử lý thêm comment

### 📁 SUPPORT Files (Có thể học sau)

Các file này hỗ trợ, nhưng không ảnh hưởng logic chính:

- `public/errors/404.php` - Trang lỗi 404
- `public/errors/error.php` - Trang lỗi chung
- `app/helpers/helpers.php` - Utility functions
- `public/.htaccess` - Apache configuration
- `public/assets/style.css` - Styling (CSS)

---

## 🗺️ Lộ trình học (7 bước)

### Bước 1: Hiểu Database (30 phút)

**File:** `database.sql`

**Học gì:**
- Cấu trúc 2 bảng: `posts` và `comments`
- Quan hệ 1-nhiều (1 post có nhiều comments)
- Các field và kiểu dữ liệu
- Foreign key constraint

**Thực hành:**
```sql
-- Mở phpMyAdmin và chạy từng câu lệnh
-- Xem cấu trúc bảng
-- Insert thử 1 record
-- Select để xem dữ liệu
```

---

### Bước 2: Kết nối Database (20 phút)

**File:** `app/config/database.php`

**Học gì:**
- PDO (PHP Data Objects)
- Connection string
- Error handling cơ bản
- Singleton pattern (getConnection function)

**Concepts:**
- `PDO::ATTR_ERRMODE` - Chế độ báo lỗi
- `PDO::ATTR_DEFAULT_FETCH_MODE` - Kiểu dữ liệu trả về
- Try-catch block

**Thực hành:**
```php
// Tạo file test-connection.php
<?php
require_once 'app/config/database.php';
$pdo = getConnection();
echo "Connected successfully!";
?>
```

---

### Bước 3: Model - Post (45 phút)

**File:** `app/models/Post.php`

**Học gì:**
- Class và OOP cơ bản
- CRUD operations:
  - `getAll()` - SELECT tất cả
  - `getById($id)` - SELECT theo ID
  - `search($keyword)` - SELECT với LIKE
  - `create($title, $content)` - INSERT
- Prepared Statements (bảo mật SQL injection)

**Concepts quan trọng:**
```php
// Prepared Statement
$stmt = $this->pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch();
```

**Thực hành:**
- Viết thêm method `update($id, $title, $content)`
- Viết thêm method `delete($id)`

---

### Bước 4: Hiển thị danh sách (60 phút)

**File:** `public/index.php`

**Học gì:**
- Flow: Browser → PHP → Model → Database → PHP → HTML
- Cách gọi Model từ View
- Vòng lặp foreach để hiển thị data
- Form search với GET method
- Pagination logic

**Flow chi tiết:**
```
1. User truy cập index.php
2. PHP nhận request
3. Gọi Post::getAll() hoặc Post::search()
4. Model query database
5. Trả về array of posts
6. Loop qua array và render HTML
7. Browser hiển thị
```

**Thực hành:**
- Thêm sort by date
- Thêm filter by keyword
- Thay đổi số bài viết mỗi trang

---

### Bước 5: Tạo bài viết mới (60 phút)

**Files:** `public/create.php` + `public/store.php`

**Học gì:**
- HTML Form với method POST
- Xử lý form submission
- Validation input
- Redirect sau khi xử lý
- Security: XSS protection với htmlspecialchars()

**Flow chi tiết:**
```
1. User click "Tạo bài viết"
2. Browser load create.php (hiển thị form)
3. User điền form và submit
4. Browser POST data đến store.php
5. store.php validate input
6. Gọi Post::create()
7. Redirect về index.php
```

**Concepts:**
```php
// GET vs POST
$_GET['search']  // Từ URL: ?search=keyword
$_POST['title']  // Từ form submission

// Validation
if (empty($title)) {
    // Show error
}

// Redirect
header("Location: index.php");
exit();
```

**Thực hành:**
- Thêm validation: title min 10 chars
- Thêm validation: content min 50 chars
- Hiển thị error message khi validation fail

---

### Bước 6: Chi tiết bài viết (60 phút)

**File:** `public/post.php`

**Học gì:**
- Nhận parameter từ URL (?id=1)
- Gọi nhiều Model cùng lúc (Post + Comment)
- Hiển thị nested data (post + comments)
- Form comment trong trang detail

**Flow chi tiết:**
```
1. User click vào bài viết
2. Browser load post.php?id=1
3. PHP lấy id từ $_GET
4. Gọi Post::getById($id)
5. Gọi Comment::getByPostId($id)
6. Render HTML với post + comments
```

**Concepts:**
```php
// Get parameter from URL
$id = $_GET['id'];  // Từ ?id=1

// Validate
if ($id <= 0) {
    redirect('404.php');
}

// Multiple queries
$post = $postModel->getById($id);
$comments = $commentModel->getByPostId($id);
```

**Thực hành:**
- Thêm "Bài viết liên quan"
- Thêm "Số lượt xem"
- Thêm nút "Sửa" và "Xóa"

---

### Bước 7: Thêm Comment (45 phút)

**File:** `public/comment.php`

**Học gì:**
- Xử lý form POST từ trang khác
- Hidden input để truyền post_id
- Redirect về trang detail sau khi xử lý

**Flow chi tiết:**
```
1. User ở trang post.php?id=1
2. User điền form comment
3. Form POST đến comment.php
4. comment.php nhận post_id và content
5. Validate input
6. Gọi Comment::create()
7. Redirect về post.php?id=1
```

**Concepts:**
```php
// Hidden input trong form
<input type="hidden" name="post_id" value="<?= $post['id'] ?>">

// Xử lý
$postId = $_POST['post_id'];
$content = $_POST['content'];

// Redirect với parameter
redirect("post.php?id=$postId");
```

**Thực hành:**
- Thêm validation: comment min 5 chars
- Thêm "Xóa comment"
- Thêm "Reply to comment" (nested comments)

---

## 🔄 Hiểu Flow tổng thể

### Flow 1: Xem danh sách bài viết
```
Browser → index.php → Post::getAll() → MySQL → Array → Loop → HTML → Browser
```

### Flow 2: Tạo bài viết mới
```
Browser → create.php (Form) → User submit → store.php → Validate → Post::create() → MySQL INSERT → Redirect → index.php
```

### Flow 3: Xem chi tiết + Comment
```
Browser → post.php?id=1 → Post::getById(1) + Comment::getByPostId(1) → MySQL → Render HTML → Browser
```

### Flow 4: Thêm comment
```
Browser (post.php) → Form submit → comment.php → Validate → Comment::create() → MySQL INSERT → Redirect → post.php?id=1
```

---

## 🎓 Concepts quan trọng cần nắm

### 1. MVC Pattern (Simplified)
- **Model:** `app/models/*.php` - Tương tác database
- **View:** HTML trong `public/*.php` - Hiển thị
- **Controller:** Logic trong `public/*.php` - Xử lý request

### 2. Security
- **SQL Injection:** Dùng Prepared Statements
- **XSS:** Dùng `htmlspecialchars()` khi output
- **CSRF:** (Chưa implement - MVP v2)

### 3. HTTP Methods
- **GET:** Lấy dữ liệu (index.php, post.php)
- **POST:** Gửi dữ liệu (store.php, comment.php)

### 4. Database Operations
- **SELECT:** Lấy dữ liệu
- **INSERT:** Thêm mới
- **UPDATE:** Cập nhật (chưa có)
- **DELETE:** Xóa (chưa có)

---

## 💡 Tips học hiệu quả

### 1. Học theo thứ tự
Đừng nhảy cóc. Học từ bước 1 → 7 tuần tự.

### 2. Code lại từ đầu
Sau khi hiểu, tạo project mới và code lại không nhìn.

### 3. Thêm features
Mỗi bước, thêm 1-2 features nhỏ để practice.

### 4. Debug bằng var_dump()
```php
var_dump($posts);  // Xem dữ liệu
die();             // Dừng execution
```

### 5. Đọc error messages
PHP error messages rất rõ ràng. Đọc kỹ để biết lỗi ở đâu.

### 6. Dùng phpMyAdmin
Xem trực tiếp data trong database để hiểu query.

---

## 🚀 Sau khi hoàn thành 7 bước

### Level 2: Thêm features
- Edit post
- Delete post
- Delete comment
- Upload image
- Like/Unlike post

### Level 3: Refactor
- Tách Controller riêng
- Implement Router
- Autoloading classes
- Environment variables

### Level 4: Advanced
- User authentication (login/register)
- Authorization (permissions)
- AJAX for comments
- Rich text editor

---

## 📝 Checklist học

- [ ] Bước 1: Hiểu database schema
- [ ] Bước 2: Kết nối database với PDO
- [ ] Bước 3: Viết Model với CRUD
- [ ] Bước 4: Hiển thị danh sách
- [ ] Bước 5: Tạo bài viết mới
- [ ] Bước 6: Hiển thị chi tiết
- [ ] Bước 7: Thêm comment
- [ ] Hiểu flow tổng thể
- [ ] Code lại từ đầu không nhìn
- [ ] Thêm 3-5 features tự nghĩ

---

## 🆘 Khi gặp khó khăn

1. **Đọc lại tài liệu** - Có thể bạn bỏ sót gì đó
2. **var_dump() debug** - Xem data ở mỗi bước
3. **Check error log** - File `logs/php_errors.log`
4. **Google error message** - Thường có câu trả lời
5. **Hỏi cộng đồng** - Stack Overflow, Reddit

---

**Good luck! 🚀**

Nhớ rằng: Học lập trình là marathon, không phải sprint. Từ từ mà chắc!
