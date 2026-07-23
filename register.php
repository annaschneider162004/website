<?php
/**
 * register.php – Trang đăng ký tài khoản
 */
session_start();

// Chuyển hướng nếu đã đăng nhập
if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$errors  = [];
$success = '';
$name    = '';
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- Lấy & làm sạch input ---
    $name     = trim(filter_input(INPUT_POST, 'name',     FILTER_DEFAULT)          ?? '');
    $email    = trim(filter_input(INPUT_POST, 'email',    FILTER_SANITIZE_EMAIL)   ?? '');
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT)          ?? '');
    $confirm  = trim(filter_input(INPUT_POST, 'confirm',  FILTER_DEFAULT)          ?? '');

    // --- Kiểm tra cơ bản ---
    if (empty($name)) {
        $errors['name'] = 'Vui lòng nhập họ và tên.';
    } elseif (mb_strlen($name) < 2) {
        $errors['name'] = 'Họ và tên phải có ít nhất 2 ký tự.';
    }

    if (empty($email)) {
        $errors['email'] = 'Vui lòng nhập địa chỉ email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Địa chỉ email không hợp lệ.';
    }

    if (empty($password)) {
        $errors['password'] = 'Vui lòng nhập mật khẩu.';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Mật khẩu phải có ít nhất 8 ký tự.';
    }

    if (empty($confirm)) {
        $errors['confirm'] = 'Vui lòng xác nhận mật khẩu.';
    } elseif ($password !== $confirm) {
        $errors['confirm'] = 'Mật khẩu xác nhận không khớp.';
    }

    // --- Xử lý đăng ký (khi không có lỗi validation) ---
    if (empty($errors)) {
        // TODO: Kết nối MySQL qua PDO và lưu tài khoản mới
        // Ví dụ:
        //   require_once 'includes/db.php';
        //   $pdo = getDB();
        //
        //   // Kiểm tra email đã tồn tại chưa
        //   $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        //   $stmt->execute([$email]);
        //   if ($stmt->fetch()) {
        //       $errors['email'] = 'Email này đã được đăng ký.';
        //   } else {
        //       $hash = password_hash($password, PASSWORD_BCRYPT);
        //       $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, created_at) VALUES (?, ?, ?, NOW())');
        //       $stmt->execute([$name, $email, $hash]);
        //       session_regenerate_id(true);
        //       $_SESSION['user_id']   = $pdo->lastInsertId();
        //       $_SESSION['user_name'] = $name;
        //       header('Location: index.php');
        //       exit;
        //   }

        // --- Placeholder (xoá khi tích hợp database thật) ---
        $success = 'Đăng ký thành công! Tính năng đang được phát triển – vui lòng thử lại sau.';
        $name = $email = '';
    }
}

$page_title = 'Đăng ký – MusicOfEveryone';
$page_desc  = 'Tạo tài khoản MusicOfEveryone miễn phí để bắt đầu hành trình âm nhạc của bạn.';
include 'includes/header.php';
?>

<main class="auth-page" style="padding-top: var(--header-h);">
  <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;">
    <div class="auth-card">

      <h1>Đăng ký</h1>
      <p class="auth-sub">Bắt đầu hành trình âm nhạc của bạn ngay hôm nay – miễn phí!</p>

      <?php if (!empty($errors['general'])): ?>
        <div class="alert alert-error" role="alert">
          <?= htmlspecialchars($errors['general']) ?>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
          <?= htmlspecialchars($success) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="register.php" novalidate>
        <!-- TODO: thêm CSRF token khi tích hợp session đầy đủ -->

        <div class="form-group">
          <label for="name">Họ và tên</label>
          <input
            type="text"
            id="name"
            name="name"
            value="<?= htmlspecialchars($name) ?>"
            placeholder="Nguyễn Văn A"
            autocomplete="name"
            class="<?= !empty($errors['name']) ? 'is-invalid' : '' ?>"
            required
          >
          <?php if (!empty($errors['name'])): ?>
            <span class="form-error-msg" role="alert"><?= htmlspecialchars($errors['name']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input
            type="email"
            id="email"
            name="email"
            value="<?= htmlspecialchars($email) ?>"
            placeholder="ban@email.com"
            autocomplete="email"
            class="<?= !empty($errors['email']) ? 'is-invalid' : '' ?>"
            required
          >
          <?php if (!empty($errors['email'])): ?>
            <span class="form-error-msg" role="alert"><?= htmlspecialchars($errors['email']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="password">Mật khẩu</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Ít nhất 8 ký tự"
            autocomplete="new-password"
            class="<?= !empty($errors['password']) ? 'is-invalid' : '' ?>"
            required
          >
          <?php if (!empty($errors['password'])): ?>
            <span class="form-error-msg" role="alert"><?= htmlspecialchars($errors['password']) ?></span>
          <?php endif; ?>
        </div>

        <div class="form-group">
          <label for="confirm">Xác nhận mật khẩu</label>
          <input
            type="password"
            id="confirm"
            name="confirm"
            placeholder="Nhập lại mật khẩu"
            autocomplete="new-password"
            class="<?= !empty($errors['confirm']) ? 'is-invalid' : '' ?>"
            required
          >
          <?php if (!empty($errors['confirm'])): ?>
            <span class="form-error-msg" role="alert"><?= htmlspecialchars($errors['confirm']) ?></span>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn-full">Tạo tài khoản</button>
      </form>

      <p class="auth-switch">
        Đã có tài khoản? <a href="login.php">Đăng nhập</a>
      </p>
      <p class="auth-switch" style="margin-top:8px;">
        <a href="index.php">← Về trang chủ</a>
      </p>

    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>
