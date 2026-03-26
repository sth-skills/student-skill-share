# 📘 LAMP PHP Project Plan – Student Skill Sharing (Updated from Architecture)

---

# 🎯 1. Mục tiêu hệ thống

Xây dựng web chia sẻ kỹ năng sống:

* Người dùng đăng bài chia sẻ kinh nghiệm
* Người khác đọc bài
* Tương tác:

  * Comment
  * Thả biểu tượng (like – optional)
* Tìm kiếm bài viết theo tiêu đề

👉 Đối tượng:

* Học sinh
* Sinh viên
* Người mới đi làm

---

# 🧱 2. Kiến trúc hệ thống (theo sơ đồ)

## Tổng quan

Browser → Apache + PHP → Application Layer → MySQL

## Chi tiết layer

### 1. Browser

* Gửi request (GET/POST)
* Hiển thị HTML

### 2. Apache + PHP

* Nhận request
* Chạy file PHP

### 3. Application Layer

* Xử lý logic
* Gồm:

  * Model
  * Business logic

### 4. Database

* Lưu trữ dữ liệu

---

# 🧠 3. Áp dụng mô hình MVC (simple)

* View: file PHP trong public/
* Model: app/models
* Controller: xử lý trực tiếp trong file PHP (không tách riêng để đơn giản)

👉 Mục tiêu: hiểu concept, không over-engineering

---

# 📂 4. Cấu trúc project

```
student-skill-share/
│
├── public/                    # Web root - Các file chính người dùng truy cập
│   ├── index.php             # ⭐ Trang chủ - danh sách bài viết
│   ├── create.php            # ⭐ Form tạo bài viết
│   ├── store.php             # ⭐ Xử lý lưu bài viết
│   ├── post.php              # ⭐ Chi tiết bài viết
│   ├── comment.php           # ⭐ Xử lý comment
│   │
│   ├── errors/               # 📁 Error handling (logic phụ)
│   │   ├── 404.php          # Trang không tìm thấy
│   │   └── error.php        # Trang lỗi chung
│   │
│   ├── assets/
│   │   └── style.css        # CSS styling
│   │
│   └── .htaccess            # Apache configuration
│
├── app/                      # Application logic
│   ├── config/
│   │   └── database.php     # Kết nối database
│   │
│   ├── models/              # 📁 Models - Tương tác với database
│   │   ├── Post.php         # Model Post
│   │   └── Comment.php      # Model Comment
│   │
│   └── helpers/
│       └── helpers.php      # Helper functions
│
├── docs/                     # Documentation
│   ├── project-plan.md      # Kế hoạch chi tiết
│   └── check-list.md        # Theo dõi tiến độ
│
├── logs/                     # Error logs
│   └── .gitkeep
│
└── database.sql             # Database schema + sample data
```

## 📚 Hướng dẫn cho người mới học

### Các file QUAN TRỌNG cần học (⭐):
1. `public/index.php` - Hiểu cách hiển thị danh sách
2. `public/create.php` - Hiểu cách tạo form
3. `public/store.php` - Hiểu cách xử lý form submission
4. `public/post.php` - Hiểu cách hiển thị chi tiết
5. `public/comment.php` - Hiểu cách xử lý comment
6. `app/models/Post.php` - Hiểu cách query database
7. `app/models/Comment.php` - Hiểu cách query database

### Các file PHỤ (có thể học sau):
- `public/errors/` - Error handling
- `public/.htaccess` - Apache config
- `app/helpers/helpers.php` - Utility functions

### Thứ tự học đề xuất:
1. Xem `database.sql` để hiểu cấu trúc database
2. Đọc `app/config/database.php` để hiểu cách kết nối
3. Đọc `app/models/Post.php` để hiểu CRUD operations
4. Đọc `public/index.php` để hiểu flow hiển thị
5. Đọc `public/create.php` + `store.php` để hiểu flow tạo mới
6. Đọc `public/post.php` để hiểu flow chi tiết
7. Áp dụng tương tự cho Comment

---

# ⚙️ 5. Setup môi trường

## 5.1 Cài XAMPP

* Cài đặt XAMPP
* Start Apache + MySQL

## 5.2 Tạo project

```
C:/xampp/htdocs/student-skill-share
```

## 5.3 Tạo database

* Vào phpMyAdmin
* Tạo DB: student_blog
* Import database.sql

## 5.4 Run project

```
http://localhost/student-skill-share/public/index.php
```

---

# 🗄️ 6. Database design

## posts

* id
* title
* content
* like_count (optional)
* created_at

## comments

* id
* post_id
* content
* created_at

👉 Quan hệ: 1 Post → nhiều Comment

---

# 🧩 7. MVP v1 (Core Version)

## 7.1 Post (quan trọng nhất)

* Tạo bài viết
* Xem danh sách bài
* Xem chi tiết bài

## 7.2 Comment

* Thêm comment
* Hiển thị comment

## 7.3 Search

* Tìm theo title

---

# 🚀 8. MVP v2 (Enhancement)

* Like bài viết (tăng count)
* Pagination (LIMIT, OFFSET)
* Validate input

---

# 🌐 9. Flow hệ thống

## 9.1 Tạo bài viết

Form → POST → PHP → Insert DB → Redirect

## 9.2 Xem danh sách

Browser → PHP → Query DB → Render HTML

## 9.3 Xem chi tiết

Browser → PHP → Query Post + Comment → Render

## 9.4 Comment

Form → POST → PHP → Insert DB → Reload

---

# 🧩 10. Feature Breakdown

## Post Management

* Create Post
* View List
* View Detail

## Comment System

* Add Comment
* View Comment

## Search

* Search by title

## UX

* Pagination
* Validation

---

# 🧠 11. Mapping Feature → Code

Create Post
→ create.php → store.php → Post model

View List
→ index.php → Post model

View Detail
→ post.php → Post + Comment model

Comment
→ post.php → comment.php → Comment model

Search
→ index.php → SQL LIKE

---

# 📌 12. Nguyên tắc thiết kế

* Mỗi feature = 1 flow
* PHP xử lý request → DB → trả HTML
* Không viết SQL trong view
* Dùng prepared statement

---

# 🔮 13. Mở rộng

* Login (session)
* Delete post/comment
* Upload image
* Refactor sang MVC chuẩn (controller riêng)

---

# ✅ 14. Kết luận

Project này giúp:

* Hiểu kiến trúc web
* Hiểu luồng request/response
* Là nền tảng để học framework

---
