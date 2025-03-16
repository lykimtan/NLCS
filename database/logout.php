<?php
session_start(); // Bắt đầu session trước khi thao tác
session_unset(); // Xóa toàn bộ biến session
session_destroy(); // Hủy session

// Điều hướng về trang chủ
header("Location: ../index.php");
exit();
?>