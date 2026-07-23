<?php
/**
 * MusicOfEveryone – Music Club
 * Trang chủ (Homepage)
 */

// Load data từ JSON
function loadJson(string $file): array {
    if (!file_exists($file)) return [];
    $content = file_get_contents($file);
    return json_decode($content, true) ?: [];
}

$dataDir   = __DIR__ . '/data/';
$settings  = loadJson($dataDir . 'settings.json');
$courses   = loadJson($dataDir . 'courses.json');
$teachers  = loadJson($dataDir . 'teachers.json');

// Defaults
$siteName  = htmlspecialchars($settings['site_name']  ?? 'MusicOfEveryone', ENT_QUOTES, 'UTF-8');
$tagline   = htmlspecialchars($settings['tagline']    ?? 'Music Club', ENT_QUOTES, 'UTF-8');
$address   = htmlspecialchars($settings['address']    ?? '', ENT_QUOTES, 'UTF-8');
$phone     = htmlspecialchars($settings['phone']      ?? '', ENT_QUOTES, 'UTF-8');
$email     = htmlspecialchars($settings['email']      ?? '', ENT_QUOTES, 'UTF-8');
$hours     = htmlspecialchars($settings['hours']      ?? '', ENT_QUOTES, 'UTF-8');
$facebook  = htmlspecialchars($settings['facebook']   ?? '#', ENT_QUOTES, 'UTF-8');
$youtube   = htmlspecialchars($settings['youtube']    ?? '#', ENT_QUOTES, 'UTF-8');
$zalo      = htmlspecialchars($settings['zalo']       ?? '', ENT_QUOTES, 'UTF-8');

// Tọa độ bản đồ (mặc định Hà Nội nếu chưa có)
$lat = isset($settings['latitude'])  && $settings['latitude']  !== '' ? (float)$settings['latitude']  : 21.0285;
$lng = isset($settings['longitude']) && $settings['longitude'] !== '' ? (float)$settings['longitude'] : 105.8542;
$mapUrl = 'https://www.google.com/maps?q=' . $lat . ',' . $lng . '&output=embed';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $siteName ?> – <?= $tagline ?></title>
    <meta name="description" content="<?= htmlspecialchars($settings['description'] ?? 'Trung tâm âm nhạc uy tín, nơi mọi lứa tuổi đều có thể học và yêu thích âm nhạc.', ENT_QUOTES, 'UTF-8') ?>">
    <meta name="robots" content="index, follow">
    <link rel="preload" href="assets/css/styles.css" as="style">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎵</text></svg>">
</head>
<body>

<!-- ====== HEADER ====== -->
<header class="header">
    <nav class="navbar">
        <a href="index.php" class="logo">
            <span class="logo-icon">🎵</span>
            <div>
                <?= $siteName ?>
                <span class="sub"><?= $tagline ?></span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="#courses" class="active">Khóa học</a></li>
            <li><a href="#teachers">Giảng viên</a></li>
            <li><a href="#location">Liên hệ</a></li>
        </ul>
        <div class="nav-actions">
            <a href="#courses" class="btn btn-primary">Đăng ký học</a>
        </div>
        <button class="hamburger" id="hamburgerBtn" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
    </nav>
</header>

<!-- Mobile Nav -->
<div class="mobile-nav-overlay" id="mobileOverlay"></div>
<nav class="mobile-nav" id="mobileNav">
    <span class="mobile-nav-close" id="mobileNavClose">✕</span>
    <a href="index.php" class="logo">
        <span class="logo-icon">🎵</span>
        <div><?= $siteName ?></div>
    </a>
    <ul>
        <li><a href="#courses">Khóa học</a></li>
        <li><a href="#teachers">Giảng viên</a></li>
        <li><a href="#location">Liên hệ</a></li>
    </ul>
    <a href="#courses" class="btn btn-primary">Đăng ký học ngay</a>
</nav>

<!-- ====== HERO ====== -->
<section class="hero">
    <div class="hero-inner">
        <div class="hero-content">
            <div class="hero-badge">🎶 Trung tâm âm nhạc uy tín</div>
            <h1 class="hero-title">
                Âm nhạc<br>
                cho <span class="accent">mọi người</span>
            </h1>
            <p class="hero-desc">
                Khám phá thế giới âm nhạc đa dạng với các khóa học chuyên nghiệp, 
                giảng viên giàu kinh nghiệm và môi trường học tập thân thiện, sáng tạo.
            </p>
            <div class="hero-actions">
                <a href="#courses" class="btn btn-accent">🎓 Xem khóa học</a>
                <a href="#location" class="btn btn-outline" style="border-color:rgba(255,255,255,.5);color:#fff;">📍 Liên hệ ngay</a>
            </div>
            <div class="hero-stats">
                <div class="stat-item">
                    <div class="stat-number">500+</div>
                    <div class="stat-label">Học viên</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">10+</div>
                    <div class="stat-label">Năm kinh nghiệm</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4</div>
                    <div class="stat-label">Khóa học</div>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-card-grid">
                <div class="hero-card">
                    <span class="icon">🎤</span>
                    <h4>Thanh Nhạc</h4>
                    <p>Rèn luyện giọng hát</p>
                </div>
                <div class="hero-card">
                    <span class="icon">🎹</span>
                    <h4>Piano</h4>
                    <p>Từ cơ bản đến nâng cao</p>
                </div>
                <div class="hero-card">
                    <span class="icon">🎻</span>
                    <h4>Violin</h4>
                    <p>Mọi lứa tuổi</p>
                </div>
                <div class="hero-card">
                    <span class="icon">🎵</span>
                    <h4>Sáo Recorder</h4>
                    <p>Cho người mới</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== WHY CHOOSE US ====== -->
<section class="section-features">
    <div class="container">
        <div class="section-heading">
            <span class="icon">⭐</span>
            <h2>Tại Sao Chọn Chúng Tôi</h2>
            <p>Cam kết mang đến trải nghiệm học nhạc tốt nhất với đội ngũ chuyên nghiệp</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon">👨‍🏫</span>
                <h3>Giảng Viên Chuyên Nghiệp</h3>
                <p>Đội ngũ giảng viên tốt nghiệp các Nhạc viện danh tiếng, nhiều năm kinh nghiệm biểu diễn và giảng dạy.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">📚</span>
                <h3>Chương Trình Chuẩn Hóa</h3>
                <p>Giáo trình được xây dựng bài bản, kết hợp phương pháp giảng dạy trong nước và quốc tế.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🎯</span>
                <h3>Học Theo Năng Lực</h3>
                <p>Lớp học nhỏ, được phân theo trình độ, đảm bảo mỗi học viên được chú ý và tiến bộ đúng tốc độ.</p>
            </div>
            <div class="feature-card">
                <span class="feature-icon">🏆</span>
                <h3>Cơ Sở Vật Chất Hiện Đại</h3>
                <p>Phòng học âm thanh cách âm, nhạc cụ chất lượng cao, môi trường học tập lý tưởng và truyền cảm hứng.</p>
            </div>
        </div>
    </div>
</section>

<!-- ====== COURSES ====== -->
<section class="section-courses" id="courses">
    <div class="container">
        <div class="section-heading">
            <span class="icon">🎓</span>
            <h2>Khóa Học Nổi Bật</h2>
            <p>Đa dạng chương trình học phù hợp mọi lứa tuổi và trình độ</p>
        </div>
        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
            <div class="course-card">
                <div class="course-img-placeholder">
                    <?php
                    $icons = ['Thanh Nhạc' => '🎤', 'Piano' => '🎹', 'Violin' => '🎻', 'Sáo Recorder' => '🪈'];
                    $icon = $icons[$course['name']] ?? '🎵';
                    echo $icon;
                    ?>
                </div>
                <div class="course-body">
                    <div class="course-header">
                        <h3 class="course-name"><?= htmlspecialchars($course['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                        <span class="badge <?= htmlspecialchars($course['level_class'] ?? 'badge-beginner', ENT_QUOTES, 'UTF-8') ?>">
                            <?= htmlspecialchars($course['level'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                        </span>
                    </div>
                    <p class="course-desc"><?= htmlspecialchars($course['description'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div class="course-meta">
                        <span>⏱ <?= htmlspecialchars($course['duration'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                        <span>📅 <?= htmlspecialchars($course['sessions'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <a href="#location" class="course-link">Đăng ký ngay →</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== TEACHERS ====== -->
<section class="section-teachers" id="teachers">
    <div class="container">
        <div class="section-heading">
            <span class="icon">👩‍🎓</span>
            <h2>Đội Ngũ Giảng Viên</h2>
            <p>Những chuyên gia âm nhạc tâm huyết, luôn sẵn sàng đồng hành cùng bạn</p>
        </div>
        <div class="teachers-grid">
            <?php foreach ($teachers as $teacher): ?>
            <div class="teacher-card">
                <div class="teacher-avatar">
                    <?php
                    $tIcons = [0 => '👨‍🎤', 1 => '👩‍🎤', 2 => '🎻', 3 => '🪈'];
                    static $tIdx = 0;
                    echo $tIcons[$tIdx % 4];
                    $tIdx++;
                    ?>
                </div>
                <h3 class="teacher-name"><?= htmlspecialchars($teacher['name'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p class="teacher-specialty"><?= htmlspecialchars($teacher['specialty'], ENT_QUOTES, 'UTF-8') ?></p>
                <p class="teacher-desc"><?= htmlspecialchars($teacher['description'], ENT_QUOTES, 'UTF-8') ?></p>
                <span class="teacher-exp">⭐ <?= htmlspecialchars($teacher['experience'] ?? '', ENT_QUOTES, 'UTF-8') ?> kinh nghiệm</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ====== CTA ====== -->
<section class="section-cta">
    <div class="container">
        <h2>Sẵn Sàng Bắt Đầu Hành Trình Âm Nhạc?</h2>
        <p>Đăng ký tư vấn miễn phí ngay hôm nay. Giảng viên sẽ tư vấn khóa học phù hợp nhất với bạn.</p>
        <a href="#location" class="btn btn-accent">📞 Liên hệ tư vấn miễn phí</a>
    </div>
</section>

<!-- ====== LOCATION / MAP ====== -->
<section class="section-location" id="location">
    <div class="container">
        <div class="section-heading">
            <span class="icon">📍</span>
            <h2>Địa Chỉ &amp; Liên Hệ</h2>
            <p>Ghé thăm chúng tôi hoặc liên hệ để được tư vấn miễn phí</p>
        </div>
        <div class="location-grid">
            <!-- Thông tin liên hệ -->
            <div class="contact-info">
                <?php if ($address): ?>
                <div class="contact-item">
                    <div class="contact-item-icon">📍</div>
                    <div class="contact-item-body">
                        <h4>Địa chỉ</h4>
                        <p><?= $address ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($phone): ?>
                <div class="contact-item">
                    <div class="contact-item-icon">📞</div>
                    <div class="contact-item-body">
                        <h4>Số điện thoại</h4>
                        <p><a href="tel:<?= preg_replace('/\s+/', '', $phone) ?>"><?= $phone ?></a></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($email): ?>
                <div class="contact-item">
                    <div class="contact-item-icon">✉️</div>
                    <div class="contact-item-body">
                        <h4>Email</h4>
                        <p><a href="mailto:<?= $email ?>"><?= $email ?></a></p>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ($hours): ?>
                <div class="contact-item">
                    <div class="contact-item-icon">🕐</div>
                    <div class="contact-item-body">
                        <h4>Giờ làm việc</h4>
                        <p><?= $hours ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <div class="social-links">
                    <?php if ($facebook && $facebook !== '#'): ?>
                    <a href="<?= $facebook ?>" class="social-link" target="_blank" rel="noopener">
                        📘 Facebook
                    </a>
                    <?php endif; ?>
                    <?php if ($youtube && $youtube !== '#'): ?>
                    <a href="<?= $youtube ?>" class="social-link" target="_blank" rel="noopener">
                        ▶️ YouTube
                    </a>
                    <?php endif; ?>
                    <?php if ($zalo): ?>
                    <a href="https://zalo.me/<?= urlencode($zalo) ?>" class="social-link" target="_blank" rel="noopener">
                        💬 Zalo
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Bản đồ -->
            <div class="map-container">
                <div class="map-wrapper">
                    <iframe
                        src="<?= htmlspecialchars($mapUrl, ENT_QUOTES, 'UTF-8') ?>"
                        title="Bản đồ <?= $siteName ?>"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                    ></iframe>
                </div>
                <div class="map-caption">
                    📍 <?= $address ?: $siteName ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== FOOTER ====== -->
<footer class="footer">
    <div class="footer-grid">
        <div class="footer-brand">
            <a href="index.php" class="logo">
                <span class="logo-icon">🎵</span>
                <div>
                    <?= $siteName ?>
                    <span class="sub" style="color:rgba(255,255,255,.6)"><?= $tagline ?></span>
                </div>
            </a>
            <p><?= htmlspecialchars($settings['description'] ?? 'Trung tâm âm nhạc uy tín, nơi mọi lứa tuổi đều có thể học và yêu thích âm nhạc.', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
        <div class="footer-col">
            <h4>Khóa học</h4>
            <ul>
                <?php foreach ($courses as $c): ?>
                <li><a href="#courses">🎵 <?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Liên hệ</h4>
            <ul>
                <?php if ($phone): ?><li><a href="tel:<?= preg_replace('/\s+/', '', $phone) ?>">📞 <?= $phone ?></a></li><?php endif; ?>
                <?php if ($email): ?><li><a href="mailto:<?= $email ?>">✉️ <?= $email ?></a></li><?php endif; ?>
                <?php if ($address): ?><li><span style="opacity:.75">📍 <?= $address ?></span></li><?php endif; ?>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Mạng xã hội</h4>
            <ul>
                <?php if ($facebook && $facebook !== '#'): ?><li><a href="<?= $facebook ?>" target="_blank" rel="noopener">📘 Facebook</a></li><?php endif; ?>
                <?php if ($youtube && $youtube !== '#'): ?><li><a href="<?= $youtube ?>" target="_blank" rel="noopener">▶️ YouTube</a></li><?php endif; ?>
                <?php if ($zalo): ?><li><a href="https://zalo.me/<?= urlencode($zalo) ?>" target="_blank" rel="noopener">💬 Zalo</a></li><?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© <?= date('Y') ?> <?= $siteName ?>. All rights reserved.</span>
        <span>Made with ❤️ for music lovers</span>
    </div>
</footer>

<!-- ====== SCRIPTS ====== -->
<script>
(function () {
    'use strict';

    var hamburger = document.getElementById('hamburgerBtn');
    var mobileNav = document.getElementById('mobileNav');
    var overlay   = document.getElementById('mobileOverlay');
    var closeBtn  = document.getElementById('mobileNavClose');

    function openMenu() {
        mobileNav.classList.add('open');
        overlay.style.display = 'block';
        document.body.style.overflow = 'hidden';
    }
    function closeMenu() {
        mobileNav.classList.remove('open');
        overlay.style.display = 'none';
        document.body.style.overflow = '';
    }

    if (hamburger) hamburger.addEventListener('click', openMenu);
    if (overlay)   overlay.addEventListener('click', closeMenu);
    if (closeBtn)  closeBtn.addEventListener('click', closeMenu);

    // Đóng menu khi click vào link
    mobileNav && mobileNav.querySelectorAll('a').forEach(function (a) {
        a.addEventListener('click', closeMenu);
    });

    // Highlight nav link khi scroll
    var sections = document.querySelectorAll('section[id]');
    var navLinks = document.querySelectorAll('.nav-links a[href^="#"]');
    window.addEventListener('scroll', function () {
        var scrollY = window.scrollY + 100;
        sections.forEach(function (section) {
            if (scrollY >= section.offsetTop && scrollY < section.offsetTop + section.offsetHeight) {
                navLinks.forEach(function (link) { link.classList.remove('active'); });
                var active = document.querySelector('.nav-links a[href="#' + section.id + '"]');
                if (active) active.classList.add('active');
            }
        });
    }, { passive: true });
})();
</script>
</body>
</html>
