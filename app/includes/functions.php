<?php
// ============================================================
// includes/functions.php — Helper functions
// Path: Project_CS381/app/includes/functions.php
// ============================================================

// تنظيف الـ input من أي كود خبيث
function sanitize($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// التحقق إن المستخدم سجل دخول
function requireLogin() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
}

// التحقق إن المستخدم admin
function requireAdmin() {
    requireLogin();
    if ($_SESSION['user_role'] !== 'admin') {
        header("Location: ../student/dashboard.php");
        exit();
    }
}

// التحقق إن المستخدم student
function requireStudent() {
    requireLogin();
    if ($_SESSION['user_role'] !== 'student') {
        header("Location: ../admin/dashboard.php");
        exit();
    }
}

// توليد CSRF token
function generateCSRF() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// التحقق من CSRF token
function verifyCSRF() {
    if (!isset($_POST['csrf_token']) || 
        $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Invalid request.");
    }
}
?>
