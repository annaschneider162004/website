<?php
/**
 * index.php – Trang chủ MusicOfEveryone Music Club
 */

// -------------------------------------------------------
// Tải dữ liệu từ JSON
// -------------------------------------------------------
function loadJson(string $file): array {
    if (!file_exists($file)) {
        error_log('loadJson: file not found: ' . $file);
        return [];
    }
    $content = file_get_contents($file);
    if ($content === false) {
        error_log('loadJson: cannot read file: ' . $file);
        return [];
    }
    $data = json_decode($content, true);
    if (!is_array($data)) {
        error_log('loadJson: invalid JSON in file: ' . $file);
        return [];
    }
    return $data;
}

/** Strips whitespace from a phone string for use in tel: links */
function normalizePhone(string $phone): string {
    return preg_replace('/\s+/', '', $phone);
}

$dataDir  = __DIR__ . '/data/';
$settings = loadJson($dataDir . 'settings.json');
$courses  = loadJson($dataDir . 'courses.json');
$teachers = loadJson($dataDir . 'teachers.json');

// Giá trị mặc định từ settings
$address  = htmlspecialchars($settings['address']  ?? '', ENT_QUOTES, 'UTF-8');
$phone    = htmlspecialchars($settings['phone']    ?? '', ENT_QUOTES, 'UTF-8');
$email    = htmlspecialchars($settings['email']    ?? '', ENT_QUOTES, 'UTF-8');
$hours    = htmlspecialchars($settings['hours']    ?? '', ENT_QUOTES, 'UTF-8');
$facebook = htmlspecialchars($settings['facebook'] ?? '', ENT_QUOTES, 'UTF-8');
$youtube  = htmlspecialchars($settings['youtube']  ?? '', ENT_QUOTES, 'UTF-8');
$zalo     = htmlspecialchars($settings['zalo']     ?? '', ENT_QUOTES, 'UTF-8');

// Tọa độ bản đồ (mặc định Hà Nội)
$lat = (isset($settings['latitude'])  && $settings['latitude']  !== '') ? (float)$settings['latitude']  : 21.0285;
$lng = (isset($settings['longitude']) && $settings['longitude'] !== '') ? (float)$settings['longitude'] : 105.8542;

// Validate lat/lng ranges
if ($lat < -90 || $lat > 90)   { $lat = 21.0285; }
if ($lng < -180 || $lng > 180) { $lng = 105.8542; }

$mapUrl = 'https://www.google.com/maps?q=' . $lat . ',' . $lng . '&output=embed';

// Màu gradient cho course card theo tên khoá học (fallback theo index)
$courseGradients = [
    'thanh nhạc' => 'linear-gradient(135deg,#064e3b 0%,#065f46 100%)',
    'piano'      => 'linear-gradient(135deg,#1e3a5f 0%,#1d4ed8 100%)',
    'violin'     => 'linear-gradient(135deg,#4c1d95 0%,#6d28d9 100%)',
    'sáo recorder' => 'linear-gradient(135deg,#92400e 0%,#d97706 100%)',
    'guitar'     => 'linear-gradient(135deg,#134e4a 0%,#0d9488 100%)',
];
$defaultGradients = [
    'linear-gradient(135deg,#064e3b 0%,#065f46 100%)',
    'linear-gradient(135deg,#1e3a5f 0%,#1d4ed8 100%)',
    'linear-gradient(135deg,#4c1d95 0%,#6d28d9 100%)',
    'linear-gradient(135deg,#92400e 0%,#d97706 100%)',
];

$page_title = 'MusicOfEveryone – Music Club | Học nhạc cho mọi lứa tuổi';
$page_desc  = 'Học nhạc online chuẩn – lộ trình rõ ràng từ cơ bản đến nâng cao, phù hợp mọi lứa tuổi. Thanh nhạc, Piano, Violin, Guitar và nhiều hơn nữa.';
include 'includes/header.php';
?>

<main>

  <!-- =============================================
       HERO SECTION
       ============================================= -->
  <section class="hero" aria-labelledby="hero-heading">
    <div class="container">
      <div class="hero-inner">

        <!-- Left: Text & CTA -->
        <div class="hero-left">
          <h1 class="hero-title" id="hero-heading">
            Học nhạc<br>cho mọi lứa tuổi
          </h1>
          <p class="hero-desc">
            Từ cơ bản đến nâng cao – Lộ trình rõ ràng – Học mọi lúc, mọi nơi
          </p>
          <a href="register.php" class="hero-cta">
            Bắt đầu hành trình &nbsp;→
          </a>
        </div>

        <!-- Right: Illustration + Level cards -->
        <div class="hero-right">
          <div class="hero-illustration" role="img" aria-label="Minh họa trẻ em chơi nhạc cụ">
            <!-- Gradient background circle -->
            <div class="bg-circle" aria-hidden="true"></div>

            <!-- SVG Illustration: 3 children playing music -->
            <svg class="main-svg" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <!-- Floating music notes -->
              <g opacity="0.7">
                <text x="60"  y="80"  font-size="24" fill="#1a7a3c">♪</text>
                <text x="400" y="60"  font-size="18" fill="#2563eb">♫</text>
                <text x="440" y="150" font-size="20" fill="#7c3aed">♩</text>
                <text x="30"  y="200" font-size="16" fill="#2563eb">♬</text>
                <text x="460" y="280" font-size="22" fill="#1a7a3c">♪</text>
                <text x="50"  y="350" font-size="18" fill="#7c3aed">♫</text>
                <text x="420" y="400" font-size="20" fill="#2563eb">♩</text>
                <text x="80"  y="440" font-size="14" fill="#1a7a3c">♬</text>
              </g>

              <!-- ===== Child 1: Guitar player (left) ===== -->
              <g transform="translate(60, 120)">
                <!-- Body -->
                <ellipse cx="60" cy="200" rx="28" ry="38" fill="#fde68a"/>
                <!-- Head -->
                <circle cx="60" cy="148" r="28" fill="#fcd34d"/>
                <!-- Hair -->
                <ellipse cx="60" cy="128" rx="28" ry="14" fill="#92400e"/>
                <!-- Eyes -->
                <circle cx="52" cy="148" r="4" fill="#1f2937"/>
                <circle cx="68" cy="148" r="4" fill="#1f2937"/>
                <!-- Smile -->
                <path d="M52 158 Q60 165 68 158" stroke="#1f2937" stroke-width="2" fill="none" stroke-linecap="round"/>
                <!-- Shirt (green) -->
                <rect x="36" y="172" width="48" height="50" rx="8" fill="#1a7a3c"/>
                <!-- Arms -->
                <rect x="16" y="175" width="22" height="12" rx="6" fill="#fcd34d"/>
                <rect x="84" y="175" width="22" height="12" rx="6" fill="#fcd34d"/>
                <!-- Legs -->
                <rect x="42" y="218" width="14" height="45" rx="7" fill="#1e40af"/>
                <rect x="62" y="218" width="14" height="45" rx="7" fill="#1e40af"/>
                <!-- Shoes -->
                <ellipse cx="49" cy="263" rx="10" ry="6" fill="#1f2937"/>
                <ellipse cx="69" cy="263" rx="10" ry="6" fill="#1f2937"/>
                <!-- Guitar body -->
                <ellipse cx="105" cy="210" rx="22" ry="26" fill="#b45309"/>
                <ellipse cx="105" cy="210" rx="14" ry="18" fill="#92400e"/>
                <!-- Guitar hole -->
                <circle cx="105" cy="210" r="7" fill="#78350f"/>
                <!-- Guitar neck -->
                <rect x="100" y="170" width="10" height="40" rx="5" fill="#d97706"/>
                <!-- Strings -->
                <line x1="103" y1="172" x2="103" y2="232" stroke="#fef3c7" stroke-width="1"/>
                <line x1="106" y1="172" x2="106" y2="232" stroke="#fef3c7" stroke-width="1"/>
                <line x1="109" y1="172" x2="109" y2="232" stroke="#fef3c7" stroke-width="1"/>
              </g>

              <!-- ===== Child 2: Keyboard player (center) ===== -->
              <g transform="translate(180, 90)">
                <!-- Body -->
                <ellipse cx="70" cy="210" rx="30" ry="40" fill="#ddd6fe"/>
                <!-- Head -->
                <circle cx="70" cy="155" r="30" fill="#fcd34d"/>
                <!-- Hair (ponytail) -->
                <ellipse cx="70" cy="133" rx="30" ry="16" fill="#1f2937"/>
                <ellipse cx="100" cy="140" rx="8" ry="16" fill="#1f2937"/>
                <!-- Eyes -->
                <circle cx="61" cy="155" r="4" fill="#1f2937"/>
                <circle cx="79" cy="155" r="4" fill="#1f2937"/>
                <!-- Smile -->
                <path d="M61 166 Q70 175 79 166" stroke="#1f2937" stroke-width="2" fill="none" stroke-linecap="round"/>
                <!-- Shirt (blue) -->
                <rect x="44" y="182" width="52" height="52" rx="8" fill="#2563eb"/>
                <!-- Arms -->
                <rect x="18" y="186" width="28" height="12" rx="6" fill="#fcd34d"/>
                <rect x="94" y="186" width="28" height="12" rx="6" fill="#fcd34d"/>
                <!-- Legs -->
                <rect x="50" y="228" width="14" height="48" rx="7" fill="#dc2626"/>
                <rect x="72" y="228" width="14" height="48" rx="7" fill="#dc2626"/>
                <!-- Shoes -->
                <ellipse cx="57" cy="276" rx="11" ry="6" fill="#1f2937"/>
                <ellipse cx="79" cy="276" rx="11" ry="6" fill="#1f2937"/>
                <!-- Keyboard / Piano -->
                <rect x="-10" y="196" width="160" height="30" rx="6" fill="#1f2937"/>
                <rect x="-8"  y="198" width="156" height="24" rx="4" fill="#f9fafb"/>
                <!-- White keys -->
                <rect x="-4"  y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="16"  y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="36"  y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="56"  y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="76"  y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="96"  y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="116" y="200" width="16" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <rect x="136" y="200" width="12" height="20" rx="2" fill="#ffffff" stroke="#d1d5db" stroke-width="1"/>
                <!-- Black keys -->
                <rect x="8"   y="200" width="10" height="13" rx="2" fill="#1f2937"/>
                <rect x="28"  y="200" width="10" height="13" rx="2" fill="#1f2937"/>
                <rect x="66"  y="200" width="10" height="13" rx="2" fill="#1f2937"/>
                <rect x="86"  y="200" width="10" height="13" rx="2" fill="#1f2937"/>
                <rect x="106" y="200" width="10" height="13" rx="2" fill="#1f2937"/>
              </g>

              <!-- ===== Child 3: Laptop / digital music (right) ===== -->
              <g transform="translate(330, 130)">
                <!-- Body -->
                <ellipse cx="60" cy="200" rx="28" ry="38" fill="#fce7f3"/>
                <!-- Head -->
                <circle cx="60" cy="148" r="28" fill="#fbbf24"/>
                <!-- Hair -->
                <ellipse cx="60" cy="130" rx="28" ry="13" fill="#7c3aed"/>
                <!-- Eyes -->
                <circle cx="52" cy="148" r="4" fill="#1f2937"/>
                <circle cx="68" cy="148" r="4" fill="#1f2937"/>
                <!-- Smile -->
                <path d="M52 160 Q60 168 68 160" stroke="#1f2937" stroke-width="2" fill="none" stroke-linecap="round"/>
                <!-- Shirt (purple) -->
                <rect x="36" y="172" width="48" height="50" rx="8" fill="#7c3aed"/>
                <!-- Arms -->
                <rect x="14" y="177" width="24" height="12" rx="6" fill="#fbbf24"/>
                <rect x="82" y="177" width="24" height="12" rx="6" fill="#fbbf24"/>
                <!-- Legs -->
                <rect x="42" y="218" width="14" height="45" rx="7" fill="#065f46"/>
                <rect x="62" y="218" width="14" height="45" rx="7" fill="#065f46"/>
                <!-- Shoes -->
                <ellipse cx="49" cy="263" rx="10" ry="6" fill="#1f2937"/>
                <ellipse cx="69" cy="263" rx="10" ry="6" fill="#1f2937"/>
                <!-- Laptop screen -->
                <rect x="-20" y="165" width="100" height="66" rx="8" fill="#1f2937"/>
                <rect x="-16" y="169" width="92" height="56" rx="5" fill="#eff6ff"/>
                <!-- Screen content: music waveform -->
                <polyline points="-8,197 -2,185 4,200 10,178 16,197 22,190 28,197 34,183 40,197 46,188 52,197 58,185 64,197 70,192 76,197"
                          stroke="#2563eb" stroke-width="2.5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                <!-- Laptop base -->
                <rect x="-26" y="231" width="112" height="10" rx="3" fill="#374151"/>
              </g>

              <!-- Decorative stars/sparkles -->
              <g fill="#fbbf24" opacity="0.8">
                <polygon points="140,50 143,60 153,60 145,66 148,76 140,70 132,76 135,66 127,60 137,60" transform="scale(0.7) translate(80,30)"/>
                <polygon points="380,80 382,87 389,87 383,92 385,99 380,95 375,99 377,92 371,87 378,87" transform="scale(0.6)"/>
              </g>
            </svg>
          </div>

          <!-- Level cards -->
          <div class="level-cards" aria-label="Các cấp độ học">
            <div class="level-card green">
              <div class="level-badge" aria-label="Cấp 1">1</div>
              <div class="level-title">Khám phá &amp; Làm quen</div>
              <div class="level-age">(6–10 tuổi)</div>
            </div>
            <div class="level-card blue">
              <div class="level-badge" aria-label="Cấp 2">2</div>
              <div class="level-title">Nâng cao kỹ năng</div>
              <div class="level-age">(11–14 tuổi)</div>
            </div>
            <div class="level-card purple">
              <div class="level-badge" aria-label="Cấp 3">3</div>
              <div class="level-title">Chuyên sâu &amp; Định hướng</div>
              <div class="level-age">(15–18 tuổi)</div>
            </div>
          </div>
        </div>
        <!-- end hero-right -->

      </div>
    </div>
  </section>
  <!-- end HERO SECTION -->

  <!-- =============================================
       FEATURE BAR
       ============================================= -->
  <section class="features" aria-label="Tính năng nổi bật">
    <div class="container">
      <div class="feature-bar" role="list">

        <div class="feature-item" role="listitem">
          <div class="feature-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2L2 7l10 5 10-5-10-5z"/>
              <path d="M2 17l10 5 10-5"/>
              <path d="M2 12l10 5 10-5"/>
            </svg>
          </div>
          <div class="feature-title">Lộ trình cá nhân hóa</div>
          <div class="feature-desc">Phù hợp với từng học viên</div>
        </div>

        <div class="feature-item" role="listitem">
          <div class="feature-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
              <line x1="8" y1="21" x2="16" y2="21"/>
              <line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
          </div>
          <div class="feature-title">Học online linh hoạt</div>
          <div class="feature-desc">Học mọi lúc, mọi nơi</div>
        </div>

        <div class="feature-item" role="listitem">
          <div class="feature-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
          </div>
          <div class="feature-title">Giáo viên chất lượng</div>
          <div class="feature-desc">Đội ngũ giàu kinh nghiệm</div>
        </div>

        <div class="feature-item" role="listitem">
          <div class="feature-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 18V5l12-2v13"/>
              <circle cx="6" cy="18" r="3"/>
              <circle cx="18" cy="16" r="3"/>
            </svg>
          </div>
          <div class="feature-title">Nội dung đa dạng</div>
          <div class="feature-desc">Cập nhật bài học mới nhất</div>
        </div>

        <div class="feature-item" role="listitem">
          <div class="feature-icon" aria-hidden="true">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="20" x2="18" y2="10"/>
              <line x1="12" y1="20" x2="12" y2="4"/>
              <line x1="6"  y1="20" x2="6"  y2="14"/>
            </svg>
          </div>
          <div class="feature-title">Theo dõi tiến độ</div>
          <div class="feature-desc">Báo cáo &amp; đánh giá chi tiết</div>
        </div>

      </div>
    </div>
  </section>
  <!-- end FEATURE BAR -->

  <!-- =============================================
       FEATURED COURSES – đọc động từ data/courses.json
       ============================================= -->
  <section class="courses" aria-labelledby="courses-heading">
    <div class="container">

      <div class="section-header">
        <h2 class="section-title" id="courses-heading">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M9 18V5l12-2v13"/>
            <circle cx="6" cy="18" r="3"/>
            <circle cx="18" cy="16" r="3"/>
          </svg>
          Khóa học nổi bật
        </h2>
        <a href="#" class="section-link">Xem tất cả khóa học →</a>
      </div>

      <div class="course-grid">
        <?php
        $courseIcons = [
            'thanh nhạc'   => '🎤',
            'piano'        => '🎹',
            'violin'       => '🎻',
            'sáo recorder' => '🪈',
            'guitar'       => '🎸',
        ];
        foreach ($courses as $idx => $course):
            $nameLower = mb_strtolower($course['name'] ?? '', 'UTF-8');
            $gradient  = $courseGradients[$nameLower] ?? $defaultGradients[$idx % count($defaultGradients)];
            $icon      = $courseIcons[$nameLower] ?? '🎵';
            $level     = htmlspecialchars($course['level'] ?? 'Cơ bản đến nâng cao', ENT_QUOTES, 'UTF-8');
            $name      = htmlspecialchars($course['name']        ?? '', ENT_QUOTES, 'UTF-8');
            $desc      = htmlspecialchars($course['description'] ?? '', ENT_QUOTES, 'UTF-8');
        ?>
        <article class="course-card" aria-label="Khóa học <?= $name ?>">
          <div class="course-card-bg" style="background:<?= $gradient ?>; display:flex; align-items:center; justify-content:center;">
            <span style="font-size:5rem; opacity:.35;"><?= $icon ?></span>
          </div>
          <div class="course-overlay" aria-hidden="true"></div>
          <div class="course-body">
            <span class="course-badge"><?= $level ?></span>
            <div class="course-name"><?= $name ?></div>
            <div class="course-desc"><?= $desc ?></div>
          </div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <!-- end FEATURED COURSES -->

  <!-- =============================================
       CTA SECTION
       ============================================= -->
  <section class="section-cta" aria-label="Đăng ký học">
    <div class="container">
      <h2>Sẵn Sàng Bắt Đầu Hành Trình Âm Nhạc?</h2>
      <p>Đăng ký tư vấn miễn phí ngay hôm nay. Giảng viên sẽ tư vấn khóa học phù hợp nhất với bạn.</p>
      <a href="#location" class="btn-cta">📞 Liên hệ tư vấn miễn phí</a>
    </div>
  </section>
  <!-- end CTA SECTION -->

  <!-- =============================================
       ĐỊA CHỈ & LIÊN HỆ – tọa độ đọc từ data/settings.json
       ============================================= -->
  <section class="section-location" id="location" aria-labelledby="location-heading">
    <div class="container">

      <div class="section-header">
        <h2 class="section-title" id="location-heading">
          📍 Địa Chỉ &amp; Liên Hệ
        </h2>
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
              <p><a href="tel:<?= htmlspecialchars(normalizePhone($phone), ENT_QUOTES, 'UTF-8') ?>"><?= $phone ?></a></p>
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

          <?php if ($facebook || $youtube || $zalo): ?>
          <div class="social-links">
            <?php if ($facebook): ?>
            <a href="<?= $facebook ?>" class="social-link" target="_blank" rel="noopener noreferrer">
              📘 Facebook
            </a>
            <?php endif; ?>
            <?php if ($youtube): ?>
            <a href="<?= $youtube ?>" class="social-link" target="_blank" rel="noopener noreferrer">
              ▶️ YouTube
            </a>
            <?php endif; ?>
            <?php if ($zalo): ?>
            <a href="https://zalo.me/<?= htmlspecialchars(urlencode($zalo), ENT_QUOTES, 'UTF-8') ?>" class="social-link" target="_blank" rel="noopener noreferrer">
              💬 Zalo
            </a>
            <?php endif; ?>
          </div>
          <?php endif; ?>
        </div>

        <!-- Bản đồ Google Maps -->
        <div class="map-container">
          <div class="map-wrapper">
            <iframe
              src="<?= htmlspecialchars($mapUrl, ENT_QUOTES, 'UTF-8') ?>"
              title="Bản đồ MusicOfEveryone"
              loading="lazy"
              allowfullscreen
              referrerpolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
          <div class="map-caption">
            📍 <?= $address ?: 'MusicOfEveryone Music Club' ?>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!-- end ĐỊA CHỈ & LIÊN HỆ -->

</main>

<?php include 'includes/footer.php'; ?>
