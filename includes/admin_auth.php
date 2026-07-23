<?php
/**
 * Bảo vệ trang admin — include file này ở đầu mỗi trang trong admin/
 * Nếu chưa đăng nhập sẽ chuyển hướng về trang đăng nhập.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_name(ADMIN_SESSION_NAME);
    session_start();
}

if (empty($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ' . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/login.php');
    exit;
}
