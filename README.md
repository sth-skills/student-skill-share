# student-skill-share

Web chia sẻ kỹ năng cho sinh viên - Học LAMP Stack

![Home Page](images/home.png)

[![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-5.7+-4479A1?logo=mysql&logoColor=white)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

---

## 📖 Giới thiệu

Nền tảng chia sẻ kinh nghiệm và kỹ năng cho sinh viên. Dự án học tập LAMP stack với code đơn giản, dễ hiểu.

**Features:** Tạo bài viết • Bình luận • Tìm kiếm • Phân trang • UI hiện đại

---

## 🚀 Quick Start

```bash
# 1. Cài XAMPP và start Apache + MySQL

# 2. Copy project vào
C:/xampp/htdocs/student-skill-share

# 3. Import database
# Mở http://localhost/phpmyadmin
# Import file: database.sql

# 4. Truy cập
http://localhost/student-skill-share/public/index.php
```

---

## � Cấu trúc

```
student-skill-share/
├── public/              # ⭐ Core - Web root
│   ├── index.php       # Trang chủ
│   ├── post.php        # Chi tiết bài viết
│   ├── create.php      # Tạo bài viết
│   ├── store.php       # Xử lý tạo bài
│   ├── comment.php     # Xử lý comment
│   └── assets/         # CSS, JS
│
├── app/                 # ⭐ Core - Logic
│   ├── models/         # Post.php, Comment.php
│   ├── config/         # database.php
│   └── helpers/        # helpers.php
│
├── docs/                # 📚 Tài liệu
└── database.sql         # ⭐ Database schema
```

---

## 🗄️ Database

```
posts (id, title, content, created_at)
  │
  └─── 1:N ───> comments (id, post_id, content, created_at)
```

---

## 🏗️ Kiến trúc

```
Browser → Apache (.htaccess) → PHP (public/*.php) 
                                  ↓
                            Models (app/models/*.php)
                                  ↓
                            MySQL (database.sql)
```

---

## 📚 Tài liệu

| File | Nội dung |
|------|----------|
| [learning-guide.md](docs/learning-guide.md) | 🎓 Hướng dẫn học 7 bước |
| [project-plan.md](docs/project-plan.md) | 📋 Kiến trúc chi tiết |
| [check-list.md](docs/check-list.md) | ✅ Tiến độ dự án |
| [demo.md](docs/demo.md) | 📸 Screenshots |

**Lộ trình học:** README → project-plan → learning-guide → code

---

## 🔒 Bảo mật

- PDO Prepared Statements (SQL injection)
- htmlspecialchars() (XSS protection)
- .htaccess security headers
- Input validation

---

## 🔧 .htaccess

File `public/.htaccess` cấu hình:
- Custom error pages (404, 500)
- Security (prevent directory listing)
- Protect config files
- Error logging

---

## � Roadmap

**MVP v1** ✅ Hoàn thành
- CRUD bài viết & comments
- Search & pagination

**MVP v2** ⏳ Đang phát triển
- User authentication
- Like, Edit, Delete
- Categories & Tags

---

## � License

MIT License

---

**Made with ❤️ for learning LAMP stack**
