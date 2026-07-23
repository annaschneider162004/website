<?php
/**
 * Partial: Teacher form fields
 * Biến $editItem được set nếu đang ở mode edit.
 */
$f = $editItem ?? [];
?>
<div class="form-grid">
    <div class="form-group full-width">
        <label for="tf_name">Họ và tên <span class="required">*</span></label>
        <input type="text" id="tf_name" name="name" class="form-control" required maxlength="100"
               value="<?= htmlspecialchars($f['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: Nguyễn Văn A">
    </div>
    <div class="form-group full-width">
        <label for="tf_specialty">Chuyên môn</label>
        <input type="text" id="tf_specialty" name="specialty" class="form-control" maxlength="100"
               value="<?= htmlspecialchars($f['specialty'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: Piano, Violin, Thanh Nhạc...">
    </div>
    <div class="form-group full-width">
        <label for="tf_desc">Mô tả ngắn</label>
        <textarea id="tf_desc" name="description" class="form-control" rows="3" maxlength="500"
                  placeholder="Giới thiệu ngắn về giảng viên..."><?= htmlspecialchars($f['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>
    <div class="form-group">
        <label for="tf_experience">Kinh nghiệm</label>
        <input type="text" id="tf_experience" name="experience" class="form-control" maxlength="30"
               value="<?= htmlspecialchars($f['experience'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: 5 năm">
    </div>
    <div class="form-group">
        <label for="tf_image">Đường dẫn ảnh</label>
        <input type="text" id="tf_image" name="image" class="form-control" maxlength="255"
               value="<?= htmlspecialchars($f['image'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
               placeholder="VD: assets/images/teacher-1.jpg">
    </div>
</div>
