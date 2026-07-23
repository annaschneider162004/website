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
│   │   ├── styles.css      # Toàn bộ CSS trang chủ (CSS variables, Flexbox, Grid, responsive)
│   │   └── admin.css       # CSS khu vực quản trị
│   ├── js/
│   │   └── main.js         # Vanilla JS: hamburger menu, smooth scroll, header shadow
│   └── images/             # Ảnh thật (thêm vào khi deploy)
├── data/                   # Dữ liệu JSON (bị chặn truy cập trực tiếp)
│   ├── courses.json        # Danh sách khóa học
│   ├── teachers.json       # Danh sách giảng viên
│   ├── settings.json       # Cài đặt website & bản đồ
│   └── .htaccess           # Chặn truy cập trực tiếp
├── includes/
│   ├── header.php          # Phần đầu trang (HTML head + site header)
│   ├── footer.php          # Phần cuối trang (site footer + script tag)
│   ├── db.php              # Khung kết nối PDO tới MySQL (điền thông tin khi deploy)
│   ├── config.php          # Cấu hình & thông tin đăng nhập admin
│   ├── admin_auth.php      # Kiểm tra session admin (dùng chung)
│   ├── admin_layout.php    # Layout & helper functions cho admin
│   ├── course_form_fields.php
│   └── teacher_form_fields.php
└── admin/
    ├── login.php           # Đăng nhập admin
    ├── logout.php          # Đăng xuất admin
    ├── index.php           # Dashboard tổng quan
    ├── courses.php         # Quản lý khóa học
    ├── teachers.php        # Quản lý giảng viên
    └── settings.php        # Cài đặt website & bản đồ
```

---

## 🔐 Trang quản trị Admin

### Truy cập

- **URL:** `/admin` hoặc `/admin/login.php`
- **Tài khoản mặc định:** `admin` / `password`

> ⚠️ **QUAN TRỌNG:** Đổi mật khẩu ngay sau khi cài đặt!

### Đổi mật khẩu admin

1. Tạo hash mật khẩu mới:
   ```bash
   php -r "echo password_hash('mật-khẩu-mới-của-bạn', PASSWORD_DEFAULT);"
   ```
2. Mở file `includes/config.php`
3. Thay giá trị `ADMIN_PASSWORD_HASH` bằng hash vừa tạo

### Tính năng quản trị

| Trang | Mô tả |
|-------|-------|
| **Dashboard** | Tổng quan: số lượng khóa học, giảng viên, trạng thái bản đồ |
| **Khóa học** | Thêm/sửa/xóa khóa học (tên, mô tả, trình độ, thời lượng) |
| **Giảng viên** | Thêm/sửa/xóa giảng viên (tên, chuyên môn, mô tả, kinh nghiệm) |
| **Cài đặt** | Thông tin website, địa chỉ, điện thoại, email, mạng xã hội, **tọa độ bản đồ** |

---

## 🗺️ Chức năng Bản đồ (Google Maps)

Trang chủ hiển thị section **"Địa Chỉ & Liên Hệ"** cuối trang, bao gồm:
- Thông tin liên hệ (địa chỉ, điện thoại, email, giờ làm việc)
- Bản đồ Google Maps nhúng bằng iframe (không cần API key)

### Cập nhật vị trí bản đồ

1. Đăng nhập vào `/admin`
2. Vào **Cài đặt** → mục **Bản đồ Google Maps**
3. Nhập **Latitude** (Vĩ độ) và **Longitude** (Kinh độ) trong `admin/settings.php`
4. Nhấn **Lưu cài đặt** → bản đồ trang chủ cập nhật ngay

**Tra cứu tọa độ:** Mở [maps.google.com](https://maps.google.com) → click chuột phải vào địa điểm → chọn tọa độ hiển thị.

Tọa độ mặc định: `21.0285, 105.8542` (Hà Nội, Việt Nam)

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

### 5. Cấu hình quyền thư mục `data/`

Đảm bảo thư mục `data/` có quyền ghi để Admin có thể lưu thay đổi:

```bash
chmod 755 data/
chmod 644 data/*.json
```

### 6. Kiểm tra SSL / HTTPS

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
