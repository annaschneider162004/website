<?php
/**
 * Partial: Course form fields
 * Dùng chung cho form thêm và sửa khóa học.
 * Biến $editItem được set nếu đang ở mode edit.
 */
$f = $editItem ?? [];
?>
<div class="form-grid">
    <div class="form-group full-width">
        <label for="cf_name">Tên khóa học <span class="required">*</span></label>
        <input type="text" id="cf_name" name="name" class="form-control" required maxlength="100"
               value="<?= htmlspecialchars($f['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: Piano, Violin, Thanh Nhạc...">
    </div>
    <div class="form-group full-width">
        <label for="cf_desc">Mô tả ngắn</label>
        <textarea id="cf_desc" name="description" class="form-control" rows="3" maxlength="500"
                  placeholder="Mô tả ngắn về khóa học..."><?= htmlspecialchars($f['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>
    <div class="form-group">
        <label for="cf_level">Trình độ</label>
        <input type="text" id="cf_level" name="level" class="form-control" maxlength="50"
               value="<?= htmlspecialchars($f['level'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: Mọi trình độ, Cơ bản – Nâng cao">
    </div>
    <div class="form-group">
        <label for="cf_level_class">Màu badge trình độ</label>
        <select id="cf_level_class" name="level_class" class="form-control">
            <option value="badge-beginner" <?= ($f['level_class'] ?? '') === 'badge-beginner'    ? 'selected' : '' ?>>🟢 Beginner (Xanh lá)</option>
            <option value="badge-intermediate" <?= ($f['level_class'] ?? '') === 'badge-intermediate' ? 'selected' : '' ?>>🟡 Intermediate (Vàng)</option>
            <option value="badge-advanced" <?= ($f['level_class'] ?? '') === 'badge-advanced'    ? 'selected' : '' ?>>🔴 Advanced (Đỏ)</option>
        </select>
    </div>
    <div class="form-group">
        <label for="cf_duration">Thời lượng</label>
        <input type="text" id="cf_duration" name="duration" class="form-control" maxlength="30"
               value="<?= htmlspecialchars($f['duration'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: 3 tháng">
    </div>
    <div class="form-group">
        <label for="cf_sessions">Số buổi/tuần</label>
        <input type="text" id="cf_sessions" name="sessions" class="form-control" maxlength="30"
               value="<?= htmlspecialchars($f['sessions'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: 2 buổi/tuần">
    </div>
    <div class="form-group full-width">
        <label for="cf_image">Đường dẫn ảnh</label>
        <input type="text" id="cf_image" name="image" class="form-control" maxlength="255"
               value="<?= htmlspecialchars($f['image'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: assets/images/course-piano.jpg">
        <span class="form-hint">Đường dẫn tương đối từ thư mục gốc website.</span>
    </div>
</div>
