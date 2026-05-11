<?php
// ============================================================
// logout.php
// Path: Project_CS381/app/logout.php
// ============================================================
session_start();
session_destroy();
header("Location: login.php");
exit();
?>