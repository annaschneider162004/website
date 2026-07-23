# MusicOfEveryone – Music Club

Website học nhạc trực tuyến cho mọi lứa tuổi, xây dựng bằng HTML/CSS/JS thuần + PHP, tối ưu tốc độ cho hosting cPanel.

---

## Cấu trúc thư mục

```
/
├── index.php            ← Trang chủ
├── .htaccess            ← Cấu hình Apache
├── assets/
│   ├── css/
│   │   ├── styles.css   ← CSS trang chủ
│   │   └── admin.css    ← CSS khu vực quản trị
│   ├── js/              ← (JavaScript tùy chọn)
│   └── images/          ← Ảnh (tự upload)
├── data/                ← Dữ liệu JSON (bị chặn truy cập trực tiếp)
│   ├── courses.json     ← Danh sách khóa học
│   ├── teachers.json    ← Danh sách giảng viên
│   ├── settings.json    ← Cài đặt website & bản đồ
│   └── .htaccess        ← Chặn truy cập trực tiếp
├── includes/
│   ├── config.php       ← Cấu hình & thông tin đăng nhập admin
│   ├── admin_auth.php   ← Kiểm tra session admin (dùng chung)
│   ├── admin_layout.php ← Layout & helper functions cho admin
│   ├── course_form_fields.php
│   ├── teacher_form_fields.php
│   └── db.php           ← Placeholder kết nối MySQL
└── admin/
    ├── login.php        ← Đăng nhập admin
    ├── logout.php       ← Đăng xuất admin
    ├── index.php        ← Dashboard tổng quan
    ├── courses.php      ← Quản lý khóa học
    ├── teachers.php     ← Quản lý giảng viên
    └── settings.php     ← Cài đặt website & bản đồ
```

---

## Trang quản trị Admin

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
| **Khóa học** | Thêm/sửa/xóa khóa học (tên, mô tả, trình độ, ảnh, thời lượng) |
| **Giảng viên** | Thêm/sửa/xóa giảng viên (tên, chuyên môn, mô tả, kinh nghiệm) |
| **Cài đặt** | Thông tin website, địa chỉ, điện thoại, email, mạng xã hội, **tọa độ bản đồ** |

---

## Chức năng Bản đồ (Google Maps)

Trang chủ hiển thị section **"Địa Chỉ & Liên Hệ"** cuối trang, bao gồm:
- Thông tin liên hệ (địa chỉ, điện thoại, email, giờ làm việc)
- Bản đồ Google Maps nhúng bằng iframe (không cần API key)

### Cập nhật vị trí bản đồ

1. Đăng nhập vào `/admin`
2. Vào **Cài đặt** → mục **Bản đồ Google Maps**
3. Nhập **Latitude** (Vĩ độ) và **Longitude** (Kinh độ)
4. Nhấn **Lưu cài đặt** → bản đồ trang chủ cập nhật ngay

**Tra cứu tọa độ:** Mở [maps.google.com](https://maps.google.com) → click chuột phải vào địa điểm → chọn tọa độ hiển thị.

Tọa độ mặc định: `21.0285, 105.8542` (Hà Nội, Việt Nam)

---

## Yêu cầu hệ thống

- PHP >= 7.4
- Apache với `mod_rewrite` bật
- Thư mục `data/` cần quyền **ghi** cho web server:
  ```bash
  chmod 755 data/
  chmod 644 data/*.json
  ```

---

## Dữ liệu mẫu

Có sẵn trong thư mục `data/`:
- `courses.json` — 4 khóa học: Thanh Nhạc, Piano, Violin, Sáo Recorder
- `teachers.json` — 4 giảng viên mẫu
- `settings.json` — Thông tin mẫu, tọa độ Hà Nội

---

## Triển khai lên cPanel

1. Upload toàn bộ file lên `public_html/` (hoặc subdirectory)
2. Đảm bảo PHP ≥ 7.4 được kích hoạt
3. Phân quyền thư mục `data/` (chmod 755) và các file JSON (chmod 644)
4. Truy cập website và đăng nhập admin tại `/admin`
5. **Đổi mật khẩu admin ngay!**

---

## Bảo mật

- Tất cả output đều được escape bằng `htmlspecialchars()`
- CSRF token cho mọi form submit
- Thư mục `data/` bị chặn truy cập trực tiếp qua `.htaccess`
- Thư mục `includes/` bị chặn qua `.htaccess`
- Session admin có tên riêng (`moe_admin_session`)
