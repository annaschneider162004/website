<?php
/**
 * Admin Panel – Đăng nhập
 *
 * DEBUG: Nếu vẫn không đăng nhập được, tạm thời bật 2 dòng dưới để xem lỗi:
 *   ini_set('display_errors', 1);
 *   error_reporting(E_ALL);
 * Truy cập lại trang và đọc thông báo lỗi. NHỚ XÓA 2 DÒNG NÀY SAU KHI DEBUG XONG!
 */
require_once __DIR__ . '/../includes/config.php';

// Fallback session save path cho shared hosting (một số host không ghi được vào thư mục mặc định)
$sessionSavePath = session_save_path();
if (empty($sessionSavePath) || !is_dir($sessionSavePath) || !is_writable($sessionSavePath)) {
    session_save_path(sys_get_temp_dir());
}

session_name(ADMIN_SESSION_NAME);
session_start();

// Đã đăng nhập thì chuyển về dashboard
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

$error = '';

// Chỉ tạo CSRF token mới khi là GET request (hoặc khi chưa có token trong session).
// KHÔNG tạo mới trên POST vì sẽ ghi đè token cũ trước khi kịp kiểm tra → CSRF luôn thất bại.
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_SESSION['csrf_token'])) {
    $csrfToken = bin2hex(random_bytes(16));
    $_SESSION['csrf_token'] = $csrfToken;
} else {
    $csrfToken = $_SESSION['csrf_token'];
}

// Xử lý form đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF
    if (empty($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'] ?? '', $_POST['csrf_token'])) {
        $error = 'Yêu cầu không hợp lệ. Vui lòng thử lại.';
        // Tạo token mới sau CSRF failure
        $csrfToken = bin2hex(random_bytes(16));
        $_SESSION['csrf_token'] = $csrfToken;
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // TODO: Thay bằng truy vấn bảng admin_users trong MySQL khi có database thật
        if ($username === ADMIN_USERNAME && password_verify($password, ADMIN_PASSWORD_HASH)) {
            session_regenerate_id(true);
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username']  = $username;
            unset($_SESSION['csrf_token']);
            header('Location: index.php');
            exit;
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng.';
            // Tạo token mới sau khi sai để tránh reuse
            $csrfToken = bin2hex(random_bytes(16));
            $_SESSION['csrf_token'] = $csrfToken;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập – Quản trị MusicOfEveryone</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="admin-login-body">
    <div class="login-card">
        <div class="login-header">
            <span class="login-icon">🎵</span>
            <h1>MusicOfEveryone</h1>
            <p>Đăng nhập vào khu vực quản trị</p>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-danger">❌ <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>

        <form class="login-form" method="POST" action="login.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
            <div>
                <label for="username">Tên đăng nhập</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="admin"
                    value="<?= htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    required
                    autocomplete="username"
                    maxlength="50"
                >
            </div>
            <div>
                <label for="password">Mật khẩu</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                    maxlength="128"
                >
            </div>
            <button type="submit" class="btn btn-primary">🔐 Đăng nhập</button>
        </form>

        <div class="login-footer">
            <a href="../index.php">← Về trang chủ</a>
        </div>
    </div>
</body>
</html>
