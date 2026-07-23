<?php
/**
<<<<<<< HEAD
 * db.php — Placeholder kết nối database
 * 
 * TODO: Khi có MySQL thật, bỏ comment đoạn PDO bên dưới và kết nối database.
 * Hiện tại dữ liệu được lưu tạm trong file JSON tại thư mục data/.
 */

require_once __DIR__ . '/config.php';

// TODO: Kết nối MySQL khi sẵn sàng
// try {
//     $pdo = new PDO(
//         'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
//         DB_USER,
//         DB_PASS,
//         [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
//     );
// } catch (PDOException $e) {
//     die('Kết nối database thất bại: ' . $e->getMessage());
// }
=======
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
// QUAN TRỌNG: Không điền thông tin thật trực tiếp vào file này nếu lưu trên git.
// Cách an toàn nhất: đặt file config NGOÀI thư mục public_html, ví dụ:
//   /home/<cpanel_user>/private/db_config.php
// rồi require_once từ đây.
//
// Hoặc dùng biến môi trường (SetEnv trong .htaccess / cPanel → Environment Variables):
//   define('DB_HOST',   getenv('DB_HOST')   ?: 'localhost');
//   define('DB_NAME',   getenv('DB_NAME')   ?: '');
//   define('DB_USER',   getenv('DB_USER')   ?: '');
//   define('DB_PASS',   getenv('DB_PASS')   ?: '');
//
// Nếu chấp nhận lưu trong file (chỉ khi file không bị expose ra web), hãy điền vào đây:
define('DB_HOST',    getenv('DB_HOST')    ?: 'localhost');   // TODO: điền tên host
define('DB_NAME',    getenv('DB_NAME')    ?: '');            // TODO: điền tên database
define('DB_USER',    getenv('DB_USER')    ?: '');            // TODO: điền username
define('DB_PASS',    getenv('DB_PASS')    ?: '');            // TODO: điền mật khẩu
define('DB_CHARSET', 'utf8mb4');

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
>>>>>>> origin/main
