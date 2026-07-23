<?php
/**
 * login.php – Trang đăng nhập
 */
session_start();

// Chuyển hướng nếu đã đăng nhập
if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Bootstrap CSRF token (header.php also does this, but we need it before POST handling)
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errors  = [];
$success = '';
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- CSRF validation ---
    $submitted_token = $_POST['csrf_token'] ?? '';
    if (empty($submitted_token)
        || empty($_SESSION['csrf_token'])
        || !hash_equals($_SESSION['csrf_token'], $submitted_token)
    ) {
        $errors['general'] = 'Yêu cầu không hợp lệ. Vui lòng thử lại.';
    } else {
        // --- Lấy & làm sạch input ---
        $email    = trim(filter_input(INPUT_POST, 'email',    FILTER_SANITIZE_EMAIL) ?? '');
        $password = trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT)        ?? '');

        // --- Kiểm tra cơ bản ---
        if (empty($email)) {
            $errors['email'] = 'Vui lòng nhập địa chỉ email.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Địa chỉ email không hợp lệ.';
        }
        if (empty($password)) {
            $errors['password'] = 'Vui lòng nhập mật khẩu.';
        }

        // --- Xử lý đăng nhập (khi không có lỗi validation) ---
        if (empty($errors)) {
            // TODO: Kết nối MySQL qua PDO và kiểm tra thông tin đăng nhập
            // Ví dụ:
            //   require_once 'includes/db.php';
            //   $pdo  = getDB();
            //   $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ?');
            //   $stmt->execute([$email]);
            //   $user = $stmt->fetch();
            //   if ($user && password_verify($password, $user['password_hash'])) {
            //       session_regenerate_id(true);
            //       $_SESSION['user_id']   = $user['id'];
            //       $_SESSION['user_name'] = $user['name'];
            //       header('Location: index.php');
            //       exit;
            //   } else {
            //       $errors['general'] = 'Email hoặc mật khẩu không đúng.';
            //   }

            // --- Placeholder (xoá khi tích hợp database thật) ---
            $errors['general'] = 'Chức năng đăng nhập đang được phát triển.';
        }
    }
}

$page_title = 'Đăng nhập – MusicOfEveryone';
$page_desc  = 'Đăng nhập vào tài khoản MusicOfEveryone để tiếp tục học nhạc.';
include 'includes/header.php';
?>

<main class="auth-page" style="padding-top: var(--header-h);">
  <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;">
    <div class="auth-card">

      <h1>Đăng nhập</h1>
      <p class="auth-sub">Chào mừng trở lại! Hãy tiếp tục hành trình âm nhạc.</p>

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

      <form method="POST" action="login.php" novalidate>
        <?= csrf_field() ?>

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
            placeholder="••••••••"
            autocomplete="current-password"
            class="<?= !empty($errors['password']) ? 'is-invalid' : '' ?>"
            required
          >
          <?php if (!empty($errors['password'])): ?>
            <span class="form-error-msg" role="alert"><?= htmlspecialchars($errors['password']) ?></span>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn-full">Đăng nhập</button>
      </form>

      <p class="auth-switch">
        Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
      </p>
      <p class="auth-switch" style="margin-top:8px;">
        <a href="index.php">← Về trang chủ</a>
      </p>

    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>


// Chuyển hướng nếu đã đăng nhập
if (!empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$errors  = [];
$success = '';
$email   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- Lấy & làm sạch input ---
    $email    = trim(filter_input(INPUT_POST, 'email',    FILTER_SANITIZE_EMAIL)   ?? '');
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_DEFAULT)          ?? '');

    // --- Kiểm tra cơ bản ---
    if (empty($email)) {
        $errors['email'] = 'Vui lòng nhập địa chỉ email.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Địa chỉ email không hợp lệ.';
    }
    if (empty($password)) {
        $errors['password'] = 'Vui lòng nhập mật khẩu.';
    }

    // --- Xử lý đăng nhập (khi không có lỗi validation) ---
    if (empty($errors)) {
        // TODO: Kết nối MySQL qua PDO và kiểm tra thông tin đăng nhập
        // Ví dụ:
        //   require_once 'includes/db.php';
        //   $pdo  = getDB();
        //   $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ?');
        //   $stmt->execute([$email]);
        //   $user = $stmt->fetch();
        //   if ($user && password_verify($password, $user['password_hash'])) {
        //       session_regenerate_id(true);
        //       $_SESSION['user_id']   = $user['id'];
        //       $_SESSION['user_name'] = $user['name'];
        //       header('Location: index.php');
        //       exit;
        //   } else {
        //       $errors['general'] = 'Email hoặc mật khẩu không đúng.';
        //   }

        // --- Placeholder (xoá khi tích hợp database thật) ---
        $errors['general'] = 'Chức năng đăng nhập đang được phát triển.';
    }
}

$page_title = 'Đăng nhập – MusicOfEveryone';
$page_desc  = 'Đăng nhập vào tài khoản MusicOfEveryone để tiếp tục học nhạc.';
include 'includes/header.php';
?>

<main class="auth-page" style="padding-top: var(--header-h);">
  <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:40px 24px;">
    <div class="auth-card">

      <h1>Đăng nhập</h1>
      <p class="auth-sub">Chào mừng trở lại! Hãy tiếp tục hành trình âm nhạc.</p>

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

      <form method="POST" action="login.php" novalidate>
        <!-- CSRF token placeholder -->
        <!-- TODO: thêm CSRF token khi tích hợp session đầy đủ -->

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
            placeholder="••••••••"
            autocomplete="current-password"
            class="<?= !empty($errors['password']) ? 'is-invalid' : '' ?>"
            required
          >
          <?php if (!empty($errors['password'])): ?>
            <span class="form-error-msg" role="alert"><?= htmlspecialchars($errors['password']) ?></span>
          <?php endif; ?>
        </div>

        <button type="submit" class="btn-full">Đăng nhập</button>
      </form>

      <p class="auth-switch">
        Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
      </p>
      <p class="auth-switch" style="margin-top:8px;">
        <a href="index.php">← Về trang chủ</a>
      </p>

    </div>
  </div>
</main>

<?php include 'includes/footer.php'; ?>
