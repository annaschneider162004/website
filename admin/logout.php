<?php
/**
 * Admin Panel – Đăng xuất
 */
session_name('moe_admin_session');
session_start();
session_destroy();
header('Location: login.php');
exit;
