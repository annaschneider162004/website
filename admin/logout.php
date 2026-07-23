<?php
/**
 * Admin Panel – Đăng xuất
 */
require_once __DIR__ . '/../includes/config.php';

session_name(ADMIN_SESSION_NAME);
session_start();
session_destroy();
header('Location: login.php');
exit;
