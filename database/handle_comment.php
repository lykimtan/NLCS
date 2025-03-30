<?php
session_start();
include 'connect.php'; 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["uid"])) {
    die("Bạn cần đăng nhập!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_SESSION["uid"];
    $post_id = intval($_POST["post_id"]); 
    $content = trim($_POST["content"]);

    if (empty($content)) {
        echo "<script>alert('Bình luận không được để trống!'); window.history.back();</script>";
        exit();
    }

    $stmt = $connect->prepare("INSERT INTO comments (post_id, uid, content) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $post_id, $uid, $content);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    } else {
        echo "<script>alert('Đã có lỗi xảy ra!'); window.history.back();</script>";
    }
}
?>