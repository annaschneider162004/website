<?php
/**
 * includes/footer.php
 * Tái sử dụng qua PHP include trên mọi trang.
 */
?>
<!-- ===== SITE FOOTER ===== -->
<footer class="site-footer" role="contentinfo">
  <div class="container">
    <div class="footer-inner">

      <!-- Brand -->
      <div class="footer-brand">
        <a href="index.php" class="logo" aria-label="MusicOfEveryone – trang chủ">
          <span class="logo-icon" aria-hidden="true">
            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="20" cy="20" r="20" fill="rgba(255,255,255,.1)"/>
              <path d="M17 8 C17 8 23 10 23 16 C23 21 19 22 18 24 C17 26 17 30 20 31 C23 32 25 29 24 27"
                    stroke="#4ade80" stroke-width="2" stroke-linecap="round" fill="none"/>
              <path d="M15 18 L25 18" stroke="#4ade80" stroke-width="1.5" stroke-linecap="round"/>
              <path d="M15 21 L25 21" stroke="#4ade80" stroke-width="1.5" stroke-linecap="round"/>
              <circle cx="18" cy="28" r="2.5" fill="#4ade80"/>
            </svg>
          </span>
          <span class="logo-text">
            <span class="logo-name">MusicOfEveryone</span>
            <span class="logo-sub">Music Club</span>
          </span>
        </a>
        <p>Học nhạc online chuẩn – lộ trình rõ ràng từ cơ bản đến nâng cao, phù hợp mọi lứa tuổi, học mọi lúc mọi nơi.</p>
      </div>

      <!-- Khóa học -->
      <div class="footer-col">
        <h4>Khóa học</h4>
        <ul>
          <li><a href="#">Thanh nhạc</a></li>
          <li><a href="#">Piano</a></li>
          <li><a href="#">Violin</a></li>
          <li><a href="#">Sáo Recorder</a></li>
          <li><a href="#">Guitar</a></li>
        </ul>
      </div>

      <!-- Hỗ trợ -->
      <div class="footer-col">
        <h4>Hỗ trợ</h4>
        <ul>
          <li><a href="#">Về chúng tôi</a></li>
          <li><a href="#">Lộ trình học</a></li>
          <li><a href="#">Giảng viên</a></li>
          <li><a href="#">Thư viện bài học</a></li>
          <li><a href="#">Cộng đồng</a></li>
        </ul>
      </div>

      <!-- Liên hệ -->
      <div class="footer-col">
        <h4>Liên hệ</h4>
        <ul>
          <li><a href="#">Email: hello@musicofeveryone.vn</a></li>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">YouTube</a></li>
          <li><a href="#">TikTok</a></li>
        </ul>
      </div>

    </div>

    <div class="footer-bottom">
      <span>&copy; <?= date('Y') ?> MusicOfEveryone Music Club. All rights reserved.</span>
      <span>Xây dựng bằng ❤️ cho âm nhạc Việt Nam</span>
    </div>
  </div>
</footer>
<!-- end SITE FOOTER -->

<script src="assets/js/main.js"></script>
</body>
</html>
