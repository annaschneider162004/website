<?php
/**
 * index.php – Trang chủ MusicOfEveryone Music Club
 */
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
       FEATURED COURSES
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

        <!-- Course 1: Thanh nhạc -->
        <article class="course-card" aria-label="Khóa học Thanh nhạc">
          <svg class="course-card-svg" viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <!-- Background gradient -->
            <defs>
              <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%"   style="stop-color:#064e3b;stop-opacity:1"/>
                <stop offset="100%" style="stop-color:#065f46;stop-opacity:1"/>
              </linearGradient>
            </defs>
            <rect width="300" height="400" fill="url(#grad1)"/>
            <!-- Decorative circles -->
            <circle cx="250" cy="50"  r="80"  fill="rgba(255,255,255,.04)"/>
            <circle cx="30"  cy="300" r="60"  fill="rgba(255,255,255,.04)"/>
            <!-- Mic illustration -->
            <rect x="138" y="130" width="24" height="50" rx="12" fill="rgba(255,255,255,.85)"/>
            <rect x="128" y="170" width="44" height="8"  rx="4"  fill="rgba(255,255,255,.6)"/>
            <rect x="147" y="178" width="6"  height="22" rx="3"  fill="rgba(255,255,255,.6)"/>
            <rect x="138" y="200" width="24" height="4"  rx="2"  fill="rgba(255,255,255,.5)"/>
            <!-- Sound waves -->
            <path d="M120 155 Q110 165 120 175" stroke="rgba(255,255,255,.5)" stroke-width="3" fill="none" stroke-linecap="round"/>
            <path d="M107 148 Q92  165 107 182" stroke="rgba(255,255,255,.35)" stroke-width="3" fill="none" stroke-linecap="round"/>
            <path d="M180 155 Q190 165 180 175" stroke="rgba(255,255,255,.5)" stroke-width="3" fill="none" stroke-linecap="round"/>
            <path d="M193 148 Q208 165 193 182" stroke="rgba(255,255,255,.35)" stroke-width="3" fill="none" stroke-linecap="round"/>
            <!-- Music note -->
            <text x="220" y="90" font-size="40" fill="rgba(255,255,255,.25)">♪</text>
            <text x="40"  y="120" font-size="28" fill="rgba(255,255,255,.2)">♫</text>
          </svg>
          <div class="course-overlay" aria-hidden="true"></div>
          <div class="course-body">
            <span class="course-badge">Cơ bản đến nâng cao</span>
            <div class="course-name">Thanh nhạc</div>
            <div class="course-desc">Học hát chuẩn – Tự tin tỏa sáng</div>
          </div>
        </article>

        <!-- Course 2: Piano -->
        <article class="course-card" aria-label="Khóa học Piano">
          <svg class="course-card-svg" viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
              <linearGradient id="grad2" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%"   style="stop-color:#1e3a5f;stop-opacity:1"/>
                <stop offset="100%" style="stop-color:#1d4ed8;stop-opacity:1"/>
              </linearGradient>
            </defs>
            <rect width="300" height="400" fill="url(#grad2)"/>
            <circle cx="260" cy="60"  r="90" fill="rgba(255,255,255,.04)"/>
            <circle cx="20"  cy="340" r="70" fill="rgba(255,255,255,.04)"/>
            <!-- Piano illustration -->
            <rect x="50" y="160" width="200" height="80" rx="8" fill="rgba(0,0,0,.5)"/>
            <rect x="54" y="164" width="192" height="68" rx="5" fill="rgba(255,255,255,.9)"/>
            <!-- White keys -->
            <rect x="58"  y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="84"  y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="110" y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="136" y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="162" y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="188" y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="214" y="166" width="22" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <rect x="240" y="166" width="10" height="60" rx="3" fill="#fff" stroke="#e5e7eb" stroke-width="1"/>
            <!-- Black keys -->
            <rect x="72"  y="166" width="14" height="38" rx="3" fill="#1f2937"/>
            <rect x="98"  y="166" width="14" height="38" rx="3" fill="#1f2937"/>
            <rect x="150" y="166" width="14" height="38" rx="3" fill="#1f2937"/>
            <rect x="176" y="166" width="14" height="38" rx="3" fill="#1f2937"/>
            <rect x="202" y="166" width="14" height="38" rx="3" fill="#1f2937"/>
            <!-- Decorative notes -->
            <text x="200" y="80"  font-size="50" fill="rgba(255,255,255,.2)">♬</text>
            <text x="30"  y="150" font-size="32" fill="rgba(255,255,255,.15)">♪</text>
          </svg>
          <div class="course-overlay" aria-hidden="true"></div>
          <div class="course-body">
            <span class="course-badge">Cơ bản đến nâng cao</span>
            <div class="course-name">Piano</div>
            <div class="course-desc">Khơi nguồn cảm hứng âm nhạc</div>
          </div>
        </article>

        <!-- Course 3: Violin -->
        <article class="course-card" aria-label="Khóa học Violin">
          <svg class="course-card-svg" viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
              <linearGradient id="grad3" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%"   style="stop-color:#4c1d95;stop-opacity:1"/>
                <stop offset="100%" style="stop-color:#6d28d9;stop-opacity:1"/>
              </linearGradient>
            </defs>
            <rect width="300" height="400" fill="url(#grad3)"/>
            <circle cx="240" cy="80"  r="100" fill="rgba(255,255,255,.04)"/>
            <circle cx="40"  cy="320" r="80"  fill="rgba(255,255,255,.04)"/>
            <!-- Violin body -->
            <ellipse cx="150" cy="240" rx="40" ry="55" fill="rgba(180,83,9,.7)"/>
            <ellipse cx="150" cy="200" rx="30" ry="35" fill="rgba(180,83,9,.7)"/>
            <!-- Violin waist -->
            <rect x="124" y="218" width="52" height="20" rx="0" fill="rgba(146,64,14,.7)"/>
            <!-- f-holes -->
            <ellipse cx="138" cy="240" rx="3" ry="12" fill="rgba(0,0,0,.4)"/>
            <ellipse cx="162" cy="240" rx="3" ry="12" fill="rgba(0,0,0,.4)"/>
            <!-- Bridge -->
            <rect x="143" y="250" width="14" height="4" rx="1" fill="rgba(255,255,255,.5)"/>
            <!-- Strings -->
            <line x1="145" y1="140" x2="145" y2="295" stroke="rgba(255,255,255,.5)" stroke-width="1"/>
            <line x1="149" y1="140" x2="149" y2="295" stroke="rgba(255,255,255,.5)" stroke-width="1"/>
            <line x1="153" y1="140" x2="153" y2="295" stroke="rgba(255,255,255,.5)" stroke-width="1"/>
            <line x1="157" y1="140" x2="157" y2="295" stroke="rgba(255,255,255,.5)" stroke-width="1"/>
            <!-- Neck -->
            <rect x="143" y="110" width="14" height="90" rx="4" fill="rgba(217,119,6,.7)"/>
            <!-- Scroll/pegs -->
            <circle cx="150" cy="108" r="8" fill="rgba(217,119,6,.7)"/>
            <!-- Bow -->
            <line x1="80" y1="100" x2="220" y2="280" stroke="rgba(255,255,255,.4)" stroke-width="3" stroke-linecap="round"/>
            <line x1="84" y1="96"  x2="224" y2="276" stroke="rgba(255,255,255,.2)" stroke-width="8"  stroke-linecap="round"/>
            <!-- Notes -->
            <text x="220" y="90"  font-size="42" fill="rgba(255,255,255,.2)">♩</text>
            <text x="30"  y="140" font-size="28" fill="rgba(255,255,255,.15)">♬</text>
          </svg>
          <div class="course-overlay" aria-hidden="true"></div>
          <div class="course-body">
            <span class="course-badge">Cơ bản đến nâng cao</span>
            <div class="course-name">Violin</div>
            <div class="course-desc">Cảm nhận giai điệu du dương</div>
          </div>
        </article>

        <!-- Course 4: Sáo Recorder -->
        <article class="course-card" aria-label="Khóa học Sáo Recorder">
          <svg class="course-card-svg" viewBox="0 0 300 400" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <defs>
              <linearGradient id="grad4" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%"   style="stop-color:#92400e;stop-opacity:1"/>
                <stop offset="100%" style="stop-color:#d97706;stop-opacity:1"/>
              </linearGradient>
            </defs>
            <rect width="300" height="400" fill="url(#grad4)"/>
            <circle cx="230" cy="70"  r="90" fill="rgba(255,255,255,.05)"/>
            <circle cx="50"  cy="340" r="75" fill="rgba(255,255,255,.05)"/>
            <!-- Recorder body (diagonal) -->
            <rect x="70" y="80" width="20" height="250" rx="10"
                  transform="rotate(15 150 200)" fill="rgba(255,255,255,.75)"/>
            <!-- Finger holes -->
            <circle cx="148" cy="140" r="5" fill="rgba(0,0,0,.35)" transform="rotate(15 150 200)"/>
            <circle cx="148" cy="165" r="5" fill="rgba(0,0,0,.35)" transform="rotate(15 150 200)"/>
            <circle cx="148" cy="190" r="5" fill="rgba(0,0,0,.35)" transform="rotate(15 150 200)"/>
            <circle cx="148" cy="215" r="5" fill="rgba(0,0,0,.35)" transform="rotate(15 150 200)"/>
            <circle cx="148" cy="240" r="5" fill="rgba(0,0,0,.35)" transform="rotate(15 150 200)"/>
            <circle cx="148" cy="265" r="5" fill="rgba(0,0,0,.35)" transform="rotate(15 150 200)"/>
            <!-- Mouthpiece -->
            <rect x="67" y="76" width="26" height="20" rx="8"
                  transform="rotate(15 150 200)" fill="rgba(255,255,255,.9)"/>
            <!-- Notes -->
            <text x="190" y="90"  font-size="45" fill="rgba(255,255,255,.2)">♫</text>
            <text x="40"  y="160" font-size="30" fill="rgba(255,255,255,.15)">♪</text>
            <text x="210" y="300" font-size="26" fill="rgba(255,255,255,.15)">♩</text>
          </svg>
          <div class="course-overlay" aria-hidden="true"></div>
          <div class="course-body">
            <span class="course-badge">Cơ bản</span>
            <div class="course-name">Sáo Recorder</div>
            <div class="course-desc">Dễ học – Dễ chơi – Dễ yêu thích</div>
          </div>
        </article>

      </div>
    </div>
  </section>
  <!-- end FEATURED COURSES -->

</main>

<?php include 'includes/footer.php'; ?>
