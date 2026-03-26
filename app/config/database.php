<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'student_blog');
define('DB_USER', 'root');
define('DB_PASS', '');

function getConnection() {
    static $pdo = null;
    
    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log error
            error_log("Database connection failed: " . $e->getMessage());
            
            // Display user-friendly error
            die("
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset='UTF-8'>
                    <title>Lỗi kết nối</title>
                    <style>
                        body { font-family: Arial; padding: 50px; background: #f5f5f5; }
                        .error-box { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: 0 auto; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                        h2 { color: #e74c3c; }
                        .steps { background: #f9f9f9; padding: 15px; border-left: 4px solid #3498db; margin: 20px 0; }
                    </style>
                </head>
                <body>
                    <div class='error-box'>
                        <h2>⚠️ Không thể kết nối database</h2>
                        <p>Vui lòng kiểm tra:</p>
                        <div class='steps'>
                            <ol>
                                <li>MySQL đã chạy trong XAMPP chưa?</li>
                                <li>Database 'student_blog' đã được tạo chưa?</li>
                                <li>Đã import file database.sql chưa?</li>
                                <li>Thông tin kết nối trong app/config/database.php đúng chưa?</li>
                            </ol>
                        </div>
                        <p><strong>Lỗi:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                        <p><a href='test-db.php' style='color: #3498db;'>→ Test kết nối database</a></p>
                    </div>
                </body>
                </html>
            ");
        }
    }
    
    return $pdo;
}
