<?php
/**
 * Bảo vệ trang admin — include file này ở đầu mỗi trang trong admin/
 * Nếu chưa đăng nhập sẽ chuyển hướng về trang đăng nhập.
 *
 * Lưu ý: config.php phải được include TRƯỚC file này để ADMIN_SESSION_NAME khả dụng.
 */

// Đảm bảo config.php đã được load (bảo vệ phòng trường hợp include thứ tự sai)
if (!defined('ADMIN_SESSION_NAME')) {
    require_once __DIR__ . '/config.php';
}

if (session_status() === PHP_SESSION_NONE) {
    // Cấu hình session path an toàn cho shared hosting
    configureSessionSavePath();
    session_name(ADMIN_SESSION_NAME);
    session_start();
}

if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/login.php');
    exit;
}
