-- Database: student_blog
-- MVP v1: Posts and Comments

CREATE DATABASE IF NOT EXISTS student_blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE student_blog;

-- Table: posts
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    like_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: comments
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Sample data for posts (short and diverse content)
INSERT INTO posts (title, content, created_at) VALUES 
('Tìm phòng trọ gần ĐH Bách Khoa giá sinh viên', 
'Mình đang tìm phòng trọ gần trường, giá khoảng 1.5-2tr/tháng. Có ai biết khu nào an toàn không?', 
NOW() - INTERVAL 5 DAY),

('Chia sẻ cách học IELTS 7.0 trong 3 tháng', 
'Mình vừa thi được 7.0 sau 3 tháng tự học. Bí quyết: luyện Speaking mỗi ngày và làm Cambridge 10-15.', 
NOW() - INTERVAL 4 DAY),

('Quán ăn ngon rẻ quanh khu Đại học Quốc Gia', 
'List quán ăn mình hay đến: Cơm tấm Phúc Lộc (25k), Bún bò Huế chị Năm (30k). Ngon bổ rẻ!', 
NOW() - INTERVAL 4 DAY),

('Xin review khóa học lập trình Udemy', 
'Các bạn học khóa Web Development của Angela Yu trên Udemy thấy thế nào? Có đáng 300k không?', 
NOW() - INTERVAL 3 DAY),

('Kinh nghiệm xin học bổng toàn phần', 
'Mình vừa nhận học bổng 100% học phí. Tips: GPA cao, hoạt động ngoại khóa, và viết essay chân thành!', 
NOW() - INTERVAL 3 DAY),

('Tìm bạn cùng học nhóm môn Cấu trúc dữ liệu', 
'Có ai học CTDL với thầy Hùng không? Tìm 2-3 bạn học nhóm cùng, mình có tài liệu hay.', 
NOW() - INTERVAL 2 DAY),

('Cách quản lý tài chính cho sinh viên', 
'Rule 50-30-20: 50% chi tiêu thiết yếu, 30% giải trí, 20% tiết kiệm. Áp dụng 6 tháng rồi, hiệu quả!', 
NOW() - INTERVAL 2 DAY),

('Gym nào gần trường giá sinh viên?', 
'Tìm phòng gym giá dưới 300k/tháng, có HLV hướng dẫn. Khu vực Thủ Đức hoặc Bình Thạnh nhé!', 
NOW() - INTERVAL 1 DAY),

('Part-time làm gì vừa học vừa làm được?', 
'Mình đang làm gia sư online 150k/h, linh hoạt giờ giấc. Ngoài ra có thể làm content writer, admin fanpage.', 
NOW() - INTERVAL 1 DAY),

('Laptop cho sinh viên IT giá 15 triệu', 
'Đang phân vân giữa Asus Vivobook, Acer Aspire 5, và Lenovo IdeaPad. Tư vấn giúp mình!', 
NOW() - INTERVAL 12 HOUR),

('Tìm mentor trong lĩnh vực Marketing', 
'Mình năm 2 ngành Marketing, muốn tìm anh chị đi trước để học hỏi kinh nghiệm thực tế.', 
NOW() - INTERVAL 10 HOUR),

('Review sách "Đắc Nhân Tâm" có đáng đọc?', 
'Nghe nhiều người recommend nhưng chưa biết có phù hợp với sinh viên không. Ai đọc rồi review giúp!', 
NOW() - INTERVAL 8 HOUR),

('Cách vượt qua stress mùa thi', 
'Tips: ngủ đủ 7-8 tiếng, tập thể dục 30 phút/ngày, chia nhỏ mục tiêu học. Đừng học gạo nhé!', 
NOW() - INTERVAL 6 HOUR),

('Tìm đồ án nhóm môn Phát triển ứng dụng Web', 
'Team mình thiếu 1 bạn làm backend (Node.js). Đồ án làm web bán hàng. Liên hệ nếu quan tâm!', 
NOW() - INTERVAL 4 HOUR),

('Chia sẻ tài liệu ôn thi TOEIC 800+', 
'Mình có bộ tài liệu ETS, Hackers và 1000 từ vựng thường gặp. Ai cần inbox mình gửi free!', 
NOW() - INTERVAL 2 HOUR),

('Quán cafe yên tĩnh để học bài', 
'Recommend: The Coffee House Võ Văn Ngân, Highlands Lê Văn Việt, Phúc Long. Học nhóm tốt!', 
NOW() - INTERVAL 1 HOUR),

('Xin lời khuyên chọn chuyên ngành', 
'Đang phân vân giữa AI và Web Development. Bạn nào đi trước tư vấn về triển vọng nghề nghiệp với!', 
NOW() - INTERVAL 30 MINUTE),

('Kinh nghiệm phỏng vấn thực tập FPT', 
'Vừa pass vòng phỏng vấn FPT Software. Họ hỏi nhiều về OOP, database và làm bài test coding.', 
NOW() - INTERVAL 15 MINUTE),

('Tìm bạn cùng chạy bộ buổi sáng', 
'Mình hay chạy công viên Gia Định 6h sáng. Tìm 2-3 bạn cùng chạy để có động lực. Newbie friendly!', 
NOW() - INTERVAL 10 MINUTE),

('Chia sẻ kênh YouTube học lập trình hay', 
'Top 3: Traversy Media (web dev), freeCodeCamp (full course), Fireship (quick tips). Xem là ghiền!', 
NOW());

-- Sample data for comments
INSERT INTO comments (post_id, content, created_at) VALUES 
-- Comments for post 1 (Tìm phòng trọ)
(1, 'Khu Linh Trung có nhiều phòng giá sinh viên đấy bạn. Mình ở đó 1.8tr/tháng!', NOW() - INTERVAL 4 DAY),
(1, 'Thử tìm trên group Facebook "Phòng trọ sinh viên Thủ Đức" nhé.', NOW() - INTERVAL 4 DAY + INTERVAL 2 HOUR),
(1, 'Mình có phòng trống tháng sau, 2tr có điều hòa. Inbox nếu quan tâm!', NOW() - INTERVAL 3 DAY),

-- Comments for post 2 (IELTS)
(2, 'Bạn học bao nhiêu giờ mỗi ngày vậy? Mình đang target 6.5 nih.', NOW() - INTERVAL 3 DAY),
(2, 'Cambridge 10-15 mua ở đâu vậy bạn? Sách giấy hay PDF?', NOW() - INTERVAL 3 DAY + INTERVAL 3 HOUR),
(2, 'Cảm ơn bạn đã share! Mình sẽ thử phương pháp này.', NOW() - INTERVAL 2 DAY),

-- Comments for post 3 (Quán ăn)
(3, 'Cơm tấm Phúc Lộc ngon thật! Thêm quán bún riêu cô Tư nữa nhé.', NOW() - INTERVAL 3 DAY),
(3, 'Saved! Tuần sau mình sẽ thử hết list này 😋', NOW() - INTERVAL 2 DAY),

-- Comments for post 4 (Khóa học Udemy)
(4, 'Khóa của Angela Yu rất đáng! Mình học xong làm được 3 project luôn.', NOW() - INTERVAL 2 DAY),
(4, 'Đợi sale Black Friday giảm còn 200k nhé bạn!', NOW() - INTERVAL 2 DAY + INTERVAL 5 HOUR),

-- Comments for post 5 (Học bổng)
(5, 'Bạn xin học bổng của trường hay tổ chức nào vậy?', NOW() - INTERVAL 2 DAY),
(5, 'Essay của bạn viết về chủ đề gì? Mình đang chuẩn bị xin học bổng.', NOW() - INTERVAL 1 DAY),

-- Comments for post 6 (Học nhóm)
(6, 'Mình học với thầy Hùng lớp K18. Add mình vào nhóm nhé!', NOW() - INTERVAL 1 DAY),
(6, 'Có slot cho 1 người nữa không? Mình cũng đang cần học nhóm.', NOW() - INTERVAL 20 HOUR),

-- Comments for post 7 (Quản lý tài chính)
(7, 'Rule này hay đấy! Mình sẽ thử áp dụng từ tháng sau.', NOW() - INTERVAL 1 DAY),
(7, 'Bạn dùng app gì để track chi tiêu vậy?', NOW() - INTERVAL 18 HOUR),

-- Comments for post 8 (Gym)
(8, 'California Fitness có chi nhánh Thủ Đức, giá 250k/tháng cho SV.', NOW() - INTERVAL 20 HOUR),
(8, 'Mình tập ở Gym Đại Học, 200k/tháng nhưng không có HLV.', NOW() - INTERVAL 15 HOUR),

-- Comments for post 9 (Part-time)
(9, 'Gia sư online kiếm được bao nhiêu/tháng vậy bạn?', NOW() - INTERVAL 18 HOUR),
(9, 'Mình làm content writer 50k/bài 500 từ. Linh hoạt giờ giấc lắm!', NOW() - INTERVAL 12 HOUR),

-- Comments for post 10 (Laptop)
(10, 'Asus Vivobook tốt đấy, mình dùng được 2 năm rồi chưa hỏng.', NOW() - INTERVAL 10 HOUR),
(10, 'Budget 15tr thì nên mua Lenovo IdeaPad, cấu hình ngon hơn.', NOW() - INTERVAL 8 HOUR),

-- Comments for post 11 (Mentor)
(11, 'Bạn thử tham gia các sự kiện networking của trường xem.', NOW() - INTERVAL 8 HOUR),

-- Comments for post 12 (Sách)
(12, 'Đắc Nhân Tâm hay lắm! Đọc xong biết cách giao tiếp tốt hơn.', NOW() - INTERVAL 6 HOUR),
(12, 'Mình thấy sách hơi cũ, nhưng nguyên lý vẫn áp dụng được.', NOW() - INTERVAL 5 HOUR),

-- Comments for post 13 (Stress)
(13, 'Cảm ơn bạn! Mình đang stress vì thi cuối kỳ nih.', NOW() - INTERVAL 4 HOUR),

-- Comments for post 14 (Đồ án)
(14, 'Mình biết Node.js cơ bản, có được không? Đồ án deadline khi nào?', NOW() - INTERVAL 3 HOUR),

-- Comments for post 15 (TOEIC)
(15, 'Inbox mình với bạn! Mình đang cần tài liệu ôn TOEIC.', NOW() - INTERVAL 1 HOUR),
(15, 'Bạn thi được bao nhiêu điểm vậy?', NOW() - INTERVAL 30 MINUTE),

-- Comments for post 16 (Cafe)
(16, 'The Coffee House Võ Văn Ngân đông lắm, khó tìm chỗ ngồi.', NOW() - INTERVAL 45 MINUTE),

-- Comments for post 17 (Chọn chuyên ngành)
(17, 'AI đang hot đấy, nhưng Web Dev dễ xin việc hơn cho fresher.', NOW() - INTERVAL 20 MINUTE),

-- Comments for post 18 (Phỏng vấn FPT)
(18, 'Cảm ơn bạn đã share! Mình sắp phỏng vấn FPT rồi.', NOW() - INTERVAL 10 MINUTE),

-- Comments for post 19 (Chạy bộ)
(19, 'Mình ở gần đó! Tham gia được không? 😊', NOW() - INTERVAL 5 MINUTE),

-- Comments for post 20 (YouTube)
(20, 'Thêm kênh Web Dev Simplified nữa nhé, giải thích dễ hiểu lắm!', NOW() - INTERVAL 2 MINUTE);
