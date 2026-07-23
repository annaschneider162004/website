<?php
/**
 * Admin Panel – Quản lý Khóa học
 * TODO: Chuyển sang MySQL bảng courses khi có database thật.
 *       CREATE TABLE courses (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), description TEXT,
 *         level VARCHAR(50), level_class VARCHAR(30), image VARCHAR(255), duration VARCHAR(30),
 *         sessions VARCHAR(30), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/admin_layout.php';

$courses  = readJsonFile(COURSES_FILE);
$message  = '';
$msgType  = 'success';
$editItem = null;

// Lấy ID tiếp theo
function nextId(array $items): int {
    if (empty($items)) return 1;
    return max(array_column($items, 'id')) + 1;
}

// Xử lý form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrf()) {
        $message = 'Yêu cầu không hợp lệ (CSRF).';
        $msgType = 'danger';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'delete') {
            $delId   = (int)($_POST['delete_id'] ?? 0);
            $courses = array_values(array_filter($courses, fn($c) => (int)$c['id'] !== $delId));
            writeJsonFile(COURSES_FILE, $courses);
            $message = 'Đã xóa khóa học.';

        } elseif ($action === 'save') {
            $id       = (int)($_POST['id'] ?? 0);
            $name     = trim($_POST['name'] ?? '');
            $desc     = trim($_POST['description'] ?? '');
            $level    = trim($_POST['level'] ?? '');
            $levelCls = trim($_POST['level_class'] ?? 'badge-beginner');
            $image    = trim($_POST['image'] ?? '');
            $duration = trim($_POST['duration'] ?? '');
            $sessions = trim($_POST['sessions'] ?? '');

            // Validate
            if ($name === '') {
                $message = 'Tên khóa học không được để trống.';
                $msgType = 'danger';
            } else {
                $newItem = [
                    'id'          => $id > 0 ? $id : nextId($courses),
                    'name'        => $name,
                    'description' => $desc,
                    'level'       => $level,
                    'level_class' => $levelCls,
                    'image'       => $image,
                    'duration'    => $duration,
                    'sessions'    => $sessions,
                ];

                if ($id > 0) {
                    // Cập nhật
                    foreach ($courses as &$c) {
                        if ((int)$c['id'] === $id) { $c = $newItem; break; }
                    }
                    unset($c);
                    $message = 'Đã cập nhật khóa học.';
                } else {
                    $courses[] = $newItem;
                    $message = 'Đã thêm khóa học mới.';
                }
                writeJsonFile(COURSES_FILE, array_values($courses));
            }
        }
        // Reload fresh data
        $courses = readJsonFile(COURSES_FILE);
    }
}

// Xem form chỉnh sửa
if (isset($_GET['edit'])) {
    $editId  = (int)$_GET['edit'];
    foreach ($courses as $c) {
        if ((int)$c['id'] === $editId) { $editItem = $c; break; }
    }
}

$csrfToken = generateCsrfToken();

adminHeader('Quản lý Khóa học', 'courses');
?>

<div class="page-header">
    <div>
        <h1>🎓 Khóa học</h1>
        <p>Quản lý danh sách khóa học hiển thị trên trang chủ</p>
    </div>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')">
        ➕ Thêm khóa học
    </button>
</div>

<?php if ($message): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<!-- Table -->
<div class="card">
    <div class="card-header"><h3>📋 Danh sách khóa học (<?= count($courses) ?>)</h3></div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên khóa học</th>
                    <th>Trình độ</th>
                    <th>Thời lượng</th>
                    <th>Buổi/tuần</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($courses)): ?>
                <tr><td colspan="6" style="text-align:center;color:var(--admin-gray-600);padding:32px;">Chưa có khóa học nào.</td></tr>
                <?php else: ?>
                <?php foreach ($courses as $c): ?>
                <tr>
                    <td><?= (int)$c['id'] ?></td>
                    <td>
                        <strong><?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?></strong>
                        <div style="font-size:.8rem;color:var(--admin-gray-600);margin-top:3px;max-width:320px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                            <?= htmlspecialchars($c['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </div>
                    </td>
                    <td><span class="badge badge-<?= htmlspecialchars(str_replace('badge-', '', $c['level_class'] ?? 'beginner'), ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($c['level'] ?? '', ENT_QUOTES, 'UTF-8') ?></span></td>
                    <td><?= htmlspecialchars($c['duration'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($c['sessions'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="?edit=<?= (int)$c['id'] ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                            <form method="POST" action="courses.php" style="display:inline;" onsubmit="return confirm('Xóa khóa học này?')">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="delete_id" value="<?= (int)$c['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm">🗑 Xóa</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Thêm khóa học -->
<div class="modal-overlay" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <h3>➕ Thêm khóa học mới</h3>
            <span class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')">✕</span>
        </div>
        <div class="modal-body">
            <form method="POST" action="courses.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="0">
                <?php include __DIR__ . '/../includes/course_form_fields.php'; ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Lưu</button>
                    <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Sửa khóa học -->
<?php if ($editItem): ?>
<div class="modal-overlay open" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <h3>✏️ Sửa khóa học</h3>
            <a href="courses.php" class="modal-close">✕</a>
        </div>
        <div class="modal-body">
            <form method="POST" action="courses.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?= (int)$editItem['id'] ?>">
                <?php include __DIR__ . '/../includes/course_form_fields.php'; ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
                    <a href="courses.php" class="btn btn-outline">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php adminFooter(); ?>
