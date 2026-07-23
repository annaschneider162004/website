<?php
/**
 * Admin Panel – Quản lý Giảng viên
 * TODO: Chuyển sang MySQL bảng teachers khi có database thật.
 *       CREATE TABLE teachers (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100), specialty VARCHAR(100),
 *         image VARCHAR(255), description TEXT, experience VARCHAR(30), created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/admin_layout.php';

$teachers = readJsonFile(TEACHERS_FILE);
$message  = '';
$msgType  = 'success';
$editItem = null;

function nextTeacherId(array $items): int {
    if (empty($items)) return 1;
    return max(array_column($items, 'id')) + 1;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrf()) {
        $message = 'Yêu cầu không hợp lệ (CSRF).';
        $msgType = 'danger';
    } else {
        $action = $_POST['action'] ?? '';

        if ($action === 'delete') {
            $delId    = (int)($_POST['delete_id'] ?? 0);
            $teachers = array_values(array_filter($teachers, fn($t) => (int)$t['id'] !== $delId));
            writeJsonFile(TEACHERS_FILE, $teachers);
            $message  = 'Đã xóa giảng viên.';

        } elseif ($action === 'save') {
            $id         = (int)($_POST['id'] ?? 0);
            $name       = trim($_POST['name'] ?? '');
            $specialty  = trim($_POST['specialty'] ?? '');
            $image      = trim($_POST['image'] ?? '');
            $desc       = trim($_POST['description'] ?? '');
            $experience = trim($_POST['experience'] ?? '');

            if ($name === '') {
                $message = 'Tên giảng viên không được để trống.';
                $msgType = 'danger';
            } else {
                $newItem = [
                    'id'          => $id > 0 ? $id : nextTeacherId($teachers),
                    'name'        => $name,
                    'specialty'   => $specialty,
                    'image'       => $image,
                    'description' => $desc,
                    'experience'  => $experience,
                ];

                if ($id > 0) {
                    foreach ($teachers as &$t) {
                        if ((int)$t['id'] === $id) { $t = $newItem; break; }
                    }
                    unset($t);
                    $message = 'Đã cập nhật giảng viên.';
                } else {
                    $teachers[] = $newItem;
                    $message    = 'Đã thêm giảng viên mới.';
                }
                writeJsonFile(TEACHERS_FILE, array_values($teachers));
            }
        }
        $teachers = readJsonFile(TEACHERS_FILE);
    }
}

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    foreach ($teachers as $t) {
        if ((int)$t['id'] === $editId) { $editItem = $t; break; }
    }
}

$csrfToken = generateCsrfToken();

adminHeader('Quản lý Giảng viên', 'teachers');
?>

<div class="page-header">
    <div>
        <h1>👨‍🏫 Giảng viên</h1>
        <p>Quản lý đội ngũ giảng viên hiển thị trên trang chủ</p>
    </div>
    <button class="btn btn-primary" onclick="document.getElementById('addModal').classList.add('open')">
        ➕ Thêm giảng viên
    </button>
</div>

<?php if ($message): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<div class="card">
    <div class="card-header"><h3>📋 Danh sách giảng viên (<?= count($teachers) ?>)</h3></div>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Họ tên</th>
                    <th>Chuyên môn</th>
                    <th>Kinh nghiệm</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($teachers)): ?>
                <tr><td colspan="5" style="text-align:center;color:var(--admin-gray-600);padding:32px;">Chưa có giảng viên nào.</td></tr>
                <?php else: ?>
                <?php foreach ($teachers as $t): ?>
                <tr>
                    <td><?= (int)$t['id'] ?></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div style="width:40px;height:40px;border-radius:50%;background:var(--admin-primary);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;">
                                <?= htmlspecialchars(mb_substr($t['name'], 0, 1), ENT_QUOTES, 'UTF-8') ?>
                            </div>
                            <div>
                                <div style="font-weight:600;"><?= htmlspecialchars($t['name'], ENT_QUOTES, 'UTF-8') ?></div>
                                <div style="font-size:.78rem;color:var(--admin-gray-600);max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    <?= htmlspecialchars($t['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($t['specialty'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($t['experience'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="?edit=<?= (int)$t['id'] ?>" class="btn btn-warning btn-sm">✏️ Sửa</a>
                            <form method="POST" action="teachers.php" style="display:inline;" onsubmit="return confirm('Xóa giảng viên này?')">
                                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="delete_id" value="<?= (int)$t['id'] ?>">
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

<!-- Modal: Thêm -->
<div class="modal-overlay" id="addModal">
    <div class="modal">
        <div class="modal-header">
            <h3>➕ Thêm giảng viên mới</h3>
            <span class="modal-close" onclick="document.getElementById('addModal').classList.remove('open')">✕</span>
        </div>
        <div class="modal-body">
            <form method="POST" action="teachers.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="0">
                <?php $editItem = null; include __DIR__ . '/../includes/teacher_form_fields.php'; ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Lưu</button>
                    <button type="button" class="btn btn-outline" onclick="document.getElementById('addModal').classList.remove('open')">Hủy</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Sửa -->
<?php if ($editItem): ?>
<div class="modal-overlay open" id="editModal">
    <div class="modal">
        <div class="modal-header">
            <h3>✏️ Sửa giảng viên</h3>
            <a href="teachers.php" class="modal-close">✕</a>
        </div>
        <div class="modal-body">
            <form method="POST" action="teachers.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?= (int)$editItem['id'] ?>">
                <?php include __DIR__ . '/../includes/teacher_form_fields.php'; ?>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">💾 Lưu thay đổi</button>
                    <a href="teachers.php" class="btn btn-outline">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php adminFooter(); ?>
