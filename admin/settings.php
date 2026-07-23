<?php
/**
 * Admin Panel – Cài đặt Website
 * Quản lý thông tin chung: tên, tagline, liên hệ, mạng xã hội, tọa độ bản đồ.
 * Dữ liệu lưu vào data/settings.json
 */
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/admin_auth.php';
require_once __DIR__ . '/../includes/admin_layout.php';

$settings = readJsonFile(SETTINGS_FILE);
$message  = '';
$msgType  = 'success';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validateCsrf()) {
        $message = 'Yêu cầu không hợp lệ (CSRF).';
        $msgType = 'danger';
    } else {
        // Validate & sanitize
        $newSettings = [
            'site_name'   => substr(trim($_POST['site_name']   ?? ''), 0, 100),
            'tagline'     => substr(trim($_POST['tagline']     ?? ''), 0, 150),
            'description' => substr(trim($_POST['description'] ?? ''), 0, 500),
            'address'     => substr(trim($_POST['address']     ?? ''), 0, 255),
            'phone'       => substr(trim($_POST['phone']       ?? ''), 0, 30),
            'email'       => substr(trim($_POST['email']       ?? ''), 0, 100),
            'hours'       => substr(trim($_POST['hours']       ?? ''), 0, 200),
            'facebook'    => substr(trim($_POST['facebook']    ?? ''), 0, 255),
            'instagram'   => substr(trim($_POST['instagram']   ?? ''), 0, 255),
            'youtube'     => substr(trim($_POST['youtube']     ?? ''), 0, 255),
            'zalo'        => substr(trim($_POST['zalo']        ?? ''), 0, 30),
            'latitude'    => '',
            'longitude'   => '',
        ];

        // Validate email
        if ($newSettings['email'] !== '' && !filter_var($newSettings['email'], FILTER_VALIDATE_EMAIL)) {
            $message = 'Địa chỉ email không hợp lệ.';
            $msgType = 'danger';
        }

        // Validate tọa độ
        $lat = trim($_POST['latitude']  ?? '');
        $lng = trim($_POST['longitude'] ?? '');
        $latFloat = ($lat !== '') ? filter_var($lat, FILTER_VALIDATE_FLOAT) : null;
        $lngFloat = ($lng !== '') ? filter_var($lng, FILTER_VALIDATE_FLOAT) : null;
        if ($lat !== '' && ($latFloat === false || $latFloat < -90 || $latFloat > 90)) {
            $message = 'Latitude phải là số hợp lệ trong khoảng -90 đến 90.';
            $msgType = 'danger';
        } elseif ($lng !== '' && ($lngFloat === false || $lngFloat < -180 || $lngFloat > 180)) {
            $message = 'Longitude phải là số hợp lệ trong khoảng -180 đến 180.';
            $msgType = 'danger';
        } else {
            $newSettings['latitude']  = $lat;
            $newSettings['longitude'] = $lng;
        }

        // Validate URL mạng xã hội
        foreach (['facebook', 'instagram', 'youtube'] as $socialField) {
            $url = $newSettings[$socialField];
            if ($url !== '' && !filter_var($url, FILTER_VALIDATE_URL)) {
                $message = "URL {$socialField} không hợp lệ.";
                $msgType = 'danger';
                break;
            }
        }

        if ($msgType === 'success') {
            if (writeJsonFile(SETTINGS_FILE, $newSettings)) {
                $settings = $newSettings;
                $message  = '✅ Đã lưu cài đặt thành công!';
            } else {
                $message = 'Không thể ghi file. Kiểm tra quyền ghi thư mục data/.';
                $msgType = 'danger';
            }
        } else {
            // Giữ lại dữ liệu người dùng vừa nhập để không mất form
            $settings = array_merge($settings, $newSettings);
        }
    }
}

$csrfToken = generateCsrfToken();
$lat = $settings['latitude']  ?? '21.0285';
$lng = $settings['longitude'] ?? '105.8542';
$previewLat = ($lat !== '') ? (float)$lat : 21.0285;
$previewLng = ($lng !== '') ? (float)$lng : 105.8542;
$previewMap = 'https://www.google.com/maps?q=' . $previewLat . ',' . $previewLng . '&output=embed';

adminHeader('Cài đặt Website', 'settings');
?>

<div class="page-header">
    <div>
        <h1>⚙️ Cài đặt Website</h1>
        <p>Quản lý thông tin chung, liên hệ, mạng xã hội và bản đồ</p>
    </div>
</div>

<?php if ($message): ?>
<div class="alert alert-<?= $msgType ?>"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div>
<?php endif; ?>

<form method="POST" action="settings.php">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

    <!-- Thông tin cơ bản -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header"><h3>🌐 Thông tin website</h3></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label for="s_site_name">Tên website <span class="required">*</span></label>
                    <input type="text" id="s_site_name" name="site_name" class="form-control" maxlength="100" required
                           value="<?= htmlspecialchars($settings['site_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="MusicOfEveryone">
                </div>
                <div class="form-group">
                    <label for="s_tagline">Tagline / Slogan</label>
                    <input type="text" id="s_tagline" name="tagline" class="form-control" maxlength="150"
                           value="<?= htmlspecialchars($settings['tagline'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="Music Club – Âm nhạc cho mọi người">
                </div>
                <div class="form-group full-width">
                    <label for="s_description">Mô tả ngắn (meta description)</label>
                    <textarea id="s_description" name="description" class="form-control" rows="2" maxlength="500"
                              placeholder="Mô tả ngắn hiển thị trên Google..."><?= htmlspecialchars($settings['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- Thông tin liên hệ -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header"><h3>📞 Thông tin liên hệ</h3></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="s_address">Địa chỉ</label>
                    <input type="text" id="s_address" name="address" class="form-control" maxlength="255"
                           value="<?= htmlspecialchars($settings['address'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="123 Phố Huế, Hai Bà Trưng, Hà Nội">
                </div>
                <div class="form-group">
                    <label for="s_phone">Số điện thoại</label>
                    <input type="text" id="s_phone" name="phone" class="form-control" maxlength="30"
                           value="<?= htmlspecialchars($settings['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="0987 654 321">
                </div>
                <div class="form-group">
                    <label for="s_email">Email</label>
                    <input type="email" id="s_email" name="email" class="form-control" maxlength="100"
                           value="<?= htmlspecialchars($settings['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="hello@musicofeveryone.vn">
                </div>
                <div class="form-group full-width">
                    <label for="s_hours">Giờ làm việc</label>
                    <input type="text" id="s_hours" name="hours" class="form-control" maxlength="200"
                           value="<?= htmlspecialchars($settings['hours'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="Thứ 2 – Thứ 7: 8:00 – 21:00 | Chủ Nhật: 9:00 – 17:00">
                </div>
            </div>
        </div>
    </div>

    <!-- Mạng xã hội -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header"><h3>📱 Mạng xã hội</h3></div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label for="s_facebook">Facebook URL</label>
                    <input type="url" id="s_facebook" name="facebook" class="form-control" maxlength="255"
                           value="<?= htmlspecialchars($settings['facebook'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="https://facebook.com/musicofeveryone">
                </div>
                <div class="form-group">
                    <label for="s_instagram">Instagram URL</label>
                    <input type="url" id="s_instagram" name="instagram" class="form-control" maxlength="255"
                           value="<?= htmlspecialchars($settings['instagram'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="https://instagram.com/musicofeveryone">
                </div>
                <div class="form-group">
                    <label for="s_youtube">YouTube URL</label>
                    <input type="url" id="s_youtube" name="youtube" class="form-control" maxlength="255"
                           value="<?= htmlspecialchars($settings['youtube'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="https://youtube.com/musicofeveryone">
                </div>
                <div class="form-group">
                    <label for="s_zalo">Số Zalo</label>
                    <input type="text" id="s_zalo" name="zalo" class="form-control" maxlength="30"
                           value="<?= htmlspecialchars($settings['zalo'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="0987654321">
                </div>
            </div>
        </div>
    </div>

    <!-- Bản đồ -->
    <div class="card" style="margin-bottom:24px;">
        <div class="card-header"><h3>🗺️ Bản đồ Google Maps</h3></div>
        <div class="card-body">
            <div class="alert alert-info">
                💡 Nhập tọa độ (latitude/longitude) để bản đồ trang chủ hiển thị đúng vị trí của bạn.
                <br>Tra cứu tọa độ tại: <a href="https://maps.google.com" target="_blank" rel="noopener" style="font-weight:700;">maps.google.com</a>
                → click chuột phải vào địa điểm → chọn tọa độ.
            </div>
            <div class="form-grid" style="margin-bottom:20px;">
                <div class="form-group">
                    <label for="s_lat">Latitude (Vĩ độ)</label>
                    <input type="number" id="s_lat" name="latitude" class="form-control"
                           step="0.000001" min="-90" max="90"
                           value="<?= htmlspecialchars($settings['latitude'] ?? '21.0285', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="21.0285">
                    <span class="form-hint">Mặc định: 21.0285 (Hà Nội)</span>
                </div>
                <div class="form-group">
                    <label for="s_lng">Longitude (Kinh độ)</label>
                    <input type="number" id="s_lng" name="longitude" class="form-control"
                           step="0.000001" min="-180" max="180"
                           value="<?= htmlspecialchars($settings['longitude'] ?? '105.8542', ENT_QUOTES, 'UTF-8') ?>"
                           placeholder="105.8542">
                    <span class="form-hint">Mặc định: 105.8542 (Hà Nội)</span>
                </div>
            </div>
            <!-- Preview bản đồ -->
            <div style="border-radius:8px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,.1);border:2px solid var(--admin-gray-200);">
                <div style="padding:8px 14px;background:var(--admin-primary);color:#fff;font-size:.85rem;font-weight:700;">
                    🗺️ Xem trước bản đồ (vị trí hiện tại đã lưu)
                </div>
                <div style="position:relative;width:100%;padding-bottom:40%;height:0;overflow:hidden;">
                    <iframe
                        src="<?= htmlspecialchars($previewMap, ENT_QUOTES, 'UTF-8') ?>"
                        style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Xem trước bản đồ"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions" style="border:none;padding:0;">
        <button type="submit" class="btn btn-primary">💾 Lưu cài đặt</button>
        <a href="../index.php" class="btn btn-outline" target="_blank">🌐 Xem trang chủ</a>
    </div>
</form>

<?php adminFooter(); ?>
