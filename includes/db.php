<?php
/**
 * db.php — Placeholder kết nối database
 * 
 * TODO: Khi có MySQL thật, bỏ comment đoạn PDO bên dưới và kết nối database.
 * Hiện tại dữ liệu được lưu tạm trong file JSON tại thư mục data/.
 */

require_once __DIR__ . '/config.php';

// TODO: Kết nối MySQL khi sẵn sàng
// try {
//     $pdo = new PDO(
//         'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
//         DB_USER,
//         DB_PASS,
//         [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
//     );
// } catch (PDOException $e) {
//     die('Kết nối database thất bại: ' . $e->getMessage());
// }
