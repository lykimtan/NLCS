<?php
session_start();
require 'connect.php'; // Kết nối CSDL

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $comment_id = $_POST['comment_id'];

    // Xóa bình luận với ID tương ứng
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $comment_id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>