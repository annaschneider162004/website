<?php
/**
 * Cấu hình chung cho website MusicOfEveryone
 * 
 * TODO: Khi có database MySQL thật, chuyển thông tin kết nối DB sang đây
 * và đổi thông tin admin sang bảng admin_users trong MySQL.
 */

// Thông tin tài khoản admin mặc định
// TODO: Đổi sang bảng admin_users trong MySQL khi có database thật
//       CREATE TABLE admin_users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(50), password_hash VARCHAR(255), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
define('ADMIN_USERNAME', 'admin');

// Mật khẩu mặc định: admin@123 — THAY ĐỔI ngay sau khi triển khai!
// Tạo hash mới: php -r "echo password_hash('mật-khẩu-mới', PASSWORD_DEFAULT);"
define('ADMIN_PASSWORD_HASH', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
// Hash trên ứng với mật khẩu: password (mặc định cho demo)
// QUAN TRỌNG: Đổi ngay mật khẩu sau khi cài đặt!

// Đường dẫn đến các file dữ liệu
define('DATA_DIR', __DIR__ . '/../data/');
define('COURSES_FILE', DATA_DIR . 'courses.json');
define('TEACHERS_FILE', DATA_DIR . 'teachers.json');
define('SETTINGS_FILE', DATA_DIR . 'settings.json');

// Tên session admin
define('ADMIN_SESSION_NAME', 'moe_admin_session');

// TODO: Cấu hình kết nối MySQL khi có database thật
// define('DB_HOST', 'localhost');
// define('DB_NAME', 'musicofeveryone');
// define('DB_USER', 'db_user');
// define('DB_PASS', 'db_password');
