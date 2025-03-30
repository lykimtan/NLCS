<?php
include_once('./connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Kiểm tra quyền chỉnh sửa bài viết
    $uid = $_SESSION['uid'];
    $check_query = "SELECT id FROM posts WHERE id = ? AND uid = ?";
    $stmt_check = $connect->prepare($check_query);
    $stmt_check->bind_param("ii", $post_id, $uid);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Cập nhật bài viết
        $update_query = "UPDATE posts SET title = ?, content = ? WHERE id = ?";
        $stmt = $connect->prepare($update_query);
        $stmt->bind_param("ssi", $title, $content, $post_id);
        
        if ($stmt->execute()) {
            echo "<script>alert('Cập nhật thành công!');</script>";
            header ("Location: ../personalAccount.php");
        } else {
            echo "<script>alert('Cập nhật thất bại!'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Bạn không có quyền chỉnh sửa bài viết này!'); history.back();</script>";
    }
}
?>