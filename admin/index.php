<?php
/**
 * Admin Panel – Dashboard (index.php)
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/admin_layout.php';

$courses  = readJsonFile(COURSES_FILE);
$teachers = readJsonFile(TEACHERS_FILE);
$settings = readJsonFile(SETTINGS_FILE);

adminHeader('Dashboard', 'dashboard');
?>

<div class="page-header">
    <div>
        <h1>📊 Dashboard</h1>
        <p>Chào mừng trở lại, <?= htmlspecialchars($_SESSION['admin_username'] ?? 'Admin', ENT_QUOTES, 'UTF-8') ?>!</p>
    </div>
    <a href="../index.php" class="btn btn-outline" target="_blank">🌐 Xem trang chủ</a>
</div>

<!-- Stats -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon">🎓</div>
        <div class="stat-info">
            <h4>Khóa học</h4>
            <div class="stat-value"><?= count($courses) ?></div>
        </div>
    </div>
    <div class="stat-card accent">
        <div class="stat-icon">👨‍🏫</div>
        <div class="stat-info">
            <h4>Giảng viên</h4>
            <div class="stat-value"><?= count($teachers) ?></div>
        </div>
    </div>
    <div class="stat-card success">
        <div class="stat-icon">📍</div>
        <div class="stat-info">
            <h4>Bản đồ</h4>
            <div class="stat-value"><?= (!empty($settings['latitude']) ? '✓' : '–') ?></div>
        </div>
    </div>
    <div class="stat-card warning">
        <div class="stat-icon">⚙️</div>
        <div class="stat-info">
            <h4>Cài đặt</h4>
            <div class="stat-value"><?= !empty($settings['site_name']) ? 'OK' : '?' ?></div>
        </div>
    </div>
</div>

<!-- Quick links -->
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;">
    <div class="card">
        <div class="card-header"><h3>🎓 Khóa học gần đây</h3> <a href="courses.php" class="btn btn-outline btn-sm">Quản lý</a></div>
        <div class="card-body">
            <?php if (empty($courses)): ?>
            <p style="color:var(--admin-gray-600);font-size:.9rem;">Chưa có khóa học nào.</p>
            <?php else: ?>
            <ul style="display:flex;flex-direction:column;gap:10px;list-style:none;">
                <?php foreach (array_slice($courses, 0, 4) as $c): ?>
                <li style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--admin-gray-200);">
                    <span style="font-weight:600;font-size:.9rem;"><?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?></span>
                    <span class="badge badge-<?= htmlspecialchars(str_replace('badge-', '', $c['level_class'] ?? 'beginner'), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($c['level'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3>👨‍🏫 Giảng viên</h3> <a href="teachers.php" class="btn btn-outline btn-sm">Quản lý</a></div>
        <div class="card-body">
            <?php if (empty($teachers)): ?>
            <p style="color:var(--admin-gray-600);font-size:.9rem;">Chưa có giảng viên nào.</p>
            <?php else: ?>
            <ul style="display:flex;flex-direction:column;gap:10px;list-style:none;">
                <?php foreach (array_slice($teachers, 0, 4) as $t): ?>
                <li style="display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid var(--admin-gray-200);">
                    <div style="width:36px;height:36px;border-radius:50%;background:var(--admin-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">
                        <?= htmlspecialchars(mb_substr($t['name'], 0, 1), ENT_QUOTES, 'UTF-8') ?>
                    </div>
                    <div>
                        <div style="font-weight:600;font-size:.9rem;"><?= htmlspecialchars($t['name'], ENT_QUOTES, 'UTF-8') ?></div>
                        <div style="font-size:.78rem;color:var(--admin-gray-600);"><?= htmlspecialchars($t['specialty'], ENT_QUOTES, 'UTF-8') ?></div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h3>⚙️ Thông tin website</h3> <a href="settings.php" class="btn btn-outline btn-sm">Chỉnh sửa</a></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:12px;">
            <?php
            $infoItems = [
                'Tên website' => $settings['site_name'] ?? '–',
                'Tagline'     => $settings['tagline']   ?? '–',
                'Địa chỉ'    => $settings['address']   ?? '–',
                'Điện thoại'  => $settings['phone']     ?? '–',
                'Email'       => $settings['email']     ?? '–',
            ];
            foreach ($infoItems as $label => $val): ?>
            <div style="display:flex;gap:8px;">
                <span style="font-size:.82rem;font-weight:700;color:var(--admin-gray-600);min-width:90px;"><?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?></span>
                <span style="font-size:.88rem;"><?= htmlspecialchars($val, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php adminFooter(); ?>
