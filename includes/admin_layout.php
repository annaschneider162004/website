<?php
/**
 * Admin shared layout helpers
 */

function adminHeader(string $pageTitle, string $activePage = ''): void {
    ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> – Quản trị MusicOfEveryone</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <meta name="robots" content="noindex, nofollow">
</head>
<body class="admin-body">

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <div class="brand-name">🎵 MusicOfEveryone</div>
        <div class="brand-sub">Khu vực quản trị</div>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="index.php" class="<?= $activePage === 'dashboard' ? 'active' : '' ?>">
                    <span class="nav-icon">📊</span> Dashboard
                </a>
            </li>
            <li>
                <a href="courses.php" class="<?= $activePage === 'courses' ? 'active' : '' ?>">
                    <span class="nav-icon">🎓</span> Khóa học
                </a>
            </li>
            <li>
                <a href="teachers.php" class="<?= $activePage === 'teachers' ? 'active' : '' ?>">
                    <span class="nav-icon">👨‍🏫</span> Giảng viên
                </a>
            </li>
            <li>
                <a href="settings.php" class="<?= $activePage === 'settings' ? 'active' : '' ?>">
                    <span class="nav-icon">⚙️</span> Cài đặt
                </a>
            </li>
            <li>
                <a href="logout.php" style="border-left-color:transparent">
                    <span class="nav-icon">🚪</span> Đăng xuất
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-footer">MusicOfEveryone © <?= date('Y') ?></div>
</aside>

<!-- Main -->
<main class="admin-main">
    <div class="admin-topbar">
        <div style="display:flex;align-items:center;gap:12px;">
            <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">☰</button>
            <span class="topbar-title"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div class="topbar-right">
            <div class="topbar-user">
                <div class="topbar-avatar">A</div>
                <span><?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin', ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <a href="logout.php" class="btn btn-outline btn-sm">Đăng xuất</a>
        </div>
    </div>
    <div class="admin-content">
    <?php
}

function adminFooter(): void {
    ?>
    </div><!-- /.admin-content -->
</main><!-- /.admin-main -->

<!-- Sidebar toggle overlay -->
<div id="sidebarOverlay" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:99;" onclick="closeSidebar()"></div>

<script>
var sidebar = document.getElementById('adminSidebar');
var overlay = document.getElementById('sidebarOverlay');
var toggleBtn = document.getElementById('sidebarToggle');

function openSidebar()  { sidebar.classList.add('open');  overlay.style.display = 'block'; }
function closeSidebar() { sidebar.classList.remove('open'); overlay.style.display = 'none'; }

if (toggleBtn) {
    toggleBtn.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
}
</script>
</body>
</html>
    <?php
}

/**
 * Đọc JSON từ file, trả về array
 */
function readJsonFile(string $file): array {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    return is_array($data) ? $data : [];
}

/**
 * Ghi dữ liệu ra file JSON
 */
function writeJsonFile(string $file, array $data): bool {
    $dir = dirname($file);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return file_put_contents($file, $json) !== false;
}

/**
 * Tạo CSRF token mới và lưu vào session
 */
function generateCsrfToken(): string {
    $token = bin2hex(random_bytes(16));
    $_SESSION['csrf_token'] = $token;
    return $token;
}

/**
 * Validate CSRF token
 */
function validateCsrf(): bool {
    return !empty($_POST['csrf_token'])
        && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}
