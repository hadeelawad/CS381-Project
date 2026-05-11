<?php
// ============================================================
// includes/auth.php — تسجيل الدخول والتسجيل والخروج
// Path: Project_CS381/app/includes/auth.php
// ============================================================
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
require 'db.php';

$action = $_POST['action'] ?? '';

// ============================================================
// تسجيل الدخول
// ============================================================
if ($action === 'login') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // جلب المستخدم من قاعدة البيانات عن طريق الإيميل
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // التحقق من كلمة السر
    if ($user && password_verify($password, $user['password'])) {

        // حفظ بيانات المستخدم في الـ session
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // توجيه كل role لصفحته
        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../student/dashboard.php");
        }
        exit();

    } else {
        // كلمة السر أو الإيميل غلط
        header("Location: ../login.php?error=invalid");
        exit();
    }
}

// ============================================================
// إنشاء حساب جديد
// ============================================================
if ($action === 'register') {

    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $role     = $_POST['role'] ?? 'student';

    // التحقق إن الإيميل مو موجود مسبقاً
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        // الإيميل موجود مسبقاً
        header("Location: ../login.php?error=exists");
        exit();
    }

    // تشفير كلمة السر قبل الحفظ
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // حفظ المستخدم الجديد
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $email, $hashed, $role]);

    // تسجيل دخول تلقائي بعد التسجيل
    $_SESSION['user_id']   = $pdo->lastInsertId();
    $_SESSION['user_name'] = $name;
    $_SESSION['user_role'] = $role;

    if ($role === 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../student/dashboard.php");
    }
    exit();
}

// ============================================================
// تسجيل الخروج
// ============================================================
if ($action === 'logout') {
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>
