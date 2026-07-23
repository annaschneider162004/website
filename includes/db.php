<?php
/**
 * includes/db.php
 * Khung kết nối PDO tới MySQL.
 *
 * Hướng dẫn deploy lên cPanel:
 * 1. Vào cPanel > MySQL Databases, tạo database và user mới.
 * 2. Điền thông tin vào các hằng số bên dưới.
 * 3. Chạy file SQL init (nếu có) trong phpMyAdmin để tạo bảng.
 *
 * KHÔNG commit thông tin thực vào repository!
 * Nên dùng biến môi trường hoặc file config ngoài webroot.
 */

// ---------- Cấu hình kết nối ----------
define('DB_HOST',   'localhost');      // Thường là localhost trên cPanel
define('DB_NAME',   'your_db_name');   // TODO: điền tên database
define('DB_USER',   'your_db_user');   // TODO: điền username database
define('DB_PASS',   'your_db_pass');   // TODO: điền mật khẩu database
define('DB_CHARSET','utf8mb4');

/**
 * Trả về đối tượng PDO singleton.
 *
 * @return PDO
 * @throws RuntimeException nếu không thể kết nối
 */
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST, DB_NAME, DB_CHARSET
        );
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Log lỗi thực tế, không hiển thị chi tiết ra ngoài
            error_log('DB connection error: ' . $e->getMessage());
            throw new RuntimeException('Không thể kết nối cơ sở dữ liệu. Vui lòng thử lại sau.');
        }
    }

    return $pdo;
}
