<?php
/**
 * includes/header.php
 * Tái sử dụng qua PHP include trên mọi trang.
 * Biến $page_title và $page_desc nên được set trước khi include.
 */
$page_title = $page_title ?? 'MusicOfEveryone – Music Club | Học nhạc cho mọi lứa tuổi';
$page_desc  = $page_desc  ?? 'Học nhạc online chuẩn – lộ trình rõ ràng từ cơ bản đến nâng cao, phù hợp mọi lứa tuổi, học mọi lúc mọi nơi.';

// ---------- CSRF helpers (session must be started before including header.php) ----------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!function_exists('csrf_field')) {
    /** Render a hidden CSRF input field. */
    function csrf_field(): string {
        return '<input type="hidden" name="csrf_token" value="'
             . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8')
             . '">';
    }
}

if (!function_exists('csrf_valid')) {
    /** Validate the CSRF token submitted via POST. */
    function csrf_valid(): bool {
        $token = $_POST['csrf_token'] ?? '';
        return !empty($token)
            && !empty($_SESSION['csrf_token'])
            && hash_equals($_SESSION['csrf_token'], $token);
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- SEO -->
  <title><?= htmlspecialchars($page_title) ?></title>
  <meta name="description" content="<?= htmlspecialchars($page_desc) ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?= htmlspecialchars((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . ($_SERVER['HTTP_HOST'] ?? '') . ($_SERVER['REQUEST_URI'] ?? '/')) ?>">

  <!-- Open Graph -->
  <meta property="og:type"        content="website">
  <meta property="og:title"       content="<?= htmlspecialchars($page_title) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($page_desc) ?>">
  <meta property="og:locale"      content="vi_VN">

  <!-- Favicon (SVG inline = zero extra request) -->
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'><text y='26' font-size='26'>🎵</text></svg>">

  <!-- Styles -->
  <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>

<!-- ===== SITE HEADER ===== -->
<header class="site-header" role="banner">
  <div class="container header-inner">

    <!-- Logo -->
    <a href="index.php" class="logo" aria-label="MusicOfEveryone – trang chủ">
      <span class="logo-icon" aria-hidden="true">
        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="20" fill="#e8f5ee"/>
          <!-- Treble clef simplified -->
          <path d="M17 8 C17 8 23 10 23 16 C23 21 19 22 18 24 C17 26 17 30 20 31 C23 32 25 29 24 27"
                stroke="#1a7a3c" stroke-width="2" stroke-linecap="round" fill="none"/>
          <path d="M15 18 L25 18" stroke="#1a7a3c" stroke-width="1.5" stroke-linecap="round"/>
          <path d="M15 21 L25 21" stroke="#1a7a3c" stroke-width="1.5" stroke-linecap="round"/>
          <circle cx="18" cy="28" r="2.5" fill="#1a7a3c"/>
        </svg>
      </span>
      <span class="logo-text">
        <span class="logo-name">MusicOfEveryone</span>
        <span class="logo-sub">Music Club</span>
      </span>
    </a>

    <!-- Navigation -->
    <nav class="nav-menu" id="nav-menu" role="navigation" aria-label="Menu chính">
      <a href="index.php" class="active">Trang chủ</a>
      <a href="#">Khóa học</a>
      <a href="#">Nhạc cụ</a>
      <a href="#">Giảng viên</a>
      <a href="#">Lộ trình</a>
      <a href="#">Thư viện</a>
      <a href="#">Cộng đồng</a>
      <a href="#">Về chúng tôi</a>
    </nav>

    <!-- CTA buttons -->
    <div class="header-cta">
      <a href="login.php"    class="btn-outline">Đăng nhập</a>
      <a href="register.php" class="btn-solid">Đăng ký</a>
    </div>

    <!-- Hamburger -->
    <button class="hamburger" id="hamburger"
            aria-expanded="false" aria-controls="nav-menu"
            aria-label="Mở/đóng menu điều hướng">
      <span></span><span></span><span></span>
    </button>

  </div>
</header>
<!-- end SITE HEADER -->
