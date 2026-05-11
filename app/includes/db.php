<?php
// ============================================================
// includes/db.php — الاتصال بقاعدة البيانات
// Path: Project_CS381/app/includes/db.php
// ============================================================

// معلومات الاتصال
$host     = 'localhost';
$dbname   = 'yic_support';
$username = 'root';
$password = '';

try {
    // إنشاء اتصال PDO آمن
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // إظهار الأخطاء بشكل واضح (نشيله في Phase 4)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // لو فشل الاتصال، وقف كل شي وأظهر الخطأ
    die("Connection failed: " . $e->getMessage());
}
?>
