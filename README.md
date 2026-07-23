# MusicOfEveryone – Music Club

Website học nhạc trực tuyến cho mọi lứa tuổi, xây dựng bằng **HTML/CSS/JS thuần + PHP**, tối ưu để chạy trên cPanel shared hosting (Apache + PHP, không cần Node.js, không cần build step).

---

## 📁 Cấu trúc thư mục

```
website/
├── index.php               # Trang chủ (landing page)
├── login.php               # Trang đăng nhập
├── register.php            # Trang đăng ký
├── .htaccess               # Tối ưu Apache: gzip, cache-control, bảo mật
├── assets/
│   ├── css/
│   │   └── styles.css      # Toàn bộ CSS (CSS variables, Flexbox, Grid, responsive)
│   ├── js/
│   │   └── main.js         # Vanilla JS: hamburger menu, smooth scroll, header shadow
│   └── images/             # Ảnh thật (thêm vào khi deploy)
└── includes/
    ├── header.php          # Phần đầu trang (HTML head + site header)
    ├── footer.php          # Phần cuối trang (site footer + script tag)
    └── db.php              # Khung kết nối PDO tới MySQL (điền thông tin khi deploy)
```

---

## 🚀 Hướng dẫn deploy lên cPanel

### 1. Upload file lên hosting

**Cách A – File Manager:**
1. Đăng nhập cPanel → mở **File Manager**.
2. Vào thư mục `public_html` (hoặc thư mục domain phụ nếu có).
3. Upload toàn bộ file và thư mục trong project này vào đó.

**Cách B – FTP:**
1. Dùng FileZilla hoặc phần mềm FTP tương tự.
2. Kết nối với thông tin FTP trong cPanel (FTP Accounts).
3. Kéo thả thư mục project vào `public_html`.

### 2. Tạo MySQL Database

1. Trong cPanel → **MySQL Databases** (hoặc MySQL Database Wizard).
2. Tạo database mới (ví dụ: `tenuser_musicdb`).
3. Tạo database user mới và gán vào database vừa tạo với quyền **ALL PRIVILEGES**.
4. Ghi nhớ: tên host (thường là `localhost`), tên database, username, password.

### 3. Cập nhật `includes/db.php`

Mở file `includes/db.php` và điền thông tin đã ghi ở bước 2:

```php
define('DB_HOST',   'localhost');
define('DB_NAME',   'tenuser_musicdb');   // tên database
define('DB_USER',   'tenuser_dbuser');    // tên user
define('DB_PASS',   'mat_khau_cua_ban'); // mật khẩu
```

> ⚠️ **Lưu ý bảo mật:** Không commit thông tin database thật vào repository. Trên môi trường production, cân nhắc dùng file config ngoài `public_html`.

### 4. Kích hoạt tính năng đăng nhập/đăng ký

Trong `login.php` và `register.php`, bỏ comment khối code **TODO** để kết nối với database MySQL sau khi đã tạo bảng `users`. Cấu trúc bảng gợi ý:

```sql
CREATE TABLE users (
    id            INT          AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    DATETIME     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 5. Kiểm tra SSL / HTTPS

Khi đã có SSL certificate (Let's Encrypt trong cPanel → SSL/TLS), bỏ comment dòng redirect trong `.htaccess`:

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}/$1 [R=301,L]
```

---

## 🎨 Công nghệ & Kỹ thuật

| Hạng mục        | Chi tiết |
|-----------------|----------|
| HTML/PHP        | PHP 7.4+ (PHP include để tái sử dụng header/footer) |
| CSS             | Thuần – CSS custom properties (`:root`), Flexbox, CSS Grid, responsive |
| JavaScript      | Vanilla JS (hamburger menu, smooth scroll) – không phụ thuộc thư viện ngoài |
| Font            | System font stack (không cần CDN) |
| Icons           | SVG inline (zero extra request, crisp mọi độ phân giải) |
| Tối ưu tốc độ   | gzip (mod_deflate), Cache-Control 1 năm cho static assets, `loading="lazy"` |
| Bảo mật         | XSS: `htmlspecialchars()` trên mọi output, CSRF token placeholder, X-Frame-Options |
| Responsive      | Desktop / Tablet / Mobile – hamburger menu trên mobile |

---

## 📞 Liên hệ

Email: hello@musicofeveryone.vn
