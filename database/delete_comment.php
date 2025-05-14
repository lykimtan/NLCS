<?php
session_start();
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["comment_id"])) {
    $comment_id = intval($_POST["comment_id"]);
    $uid = $_SESSION["uid"] ?? null;

    if (!$uid) {
        echo json_encode(["status" => "error", "message" => "Bạn cần đăng nhập để xóa bình luận."]);
        exit;
    }

    // Kiểm tra xem bình luận có thuộc về người dùng hiện tại không
    $checkQuery = $connect->prepare("SELECT uid FROM comments WHERE id = ?");
    $checkQuery->bind_param("i", $comment_id);
    $checkQuery->execute();
    $result = $checkQuery->get_result();
    $comment = $result->fetch_assoc();

    if (!$comment) {
        echo json_encode(["status" => "error", "message" => "Bình luận không tồn tại."]);
        exit;
    }

    if ($comment["uid"] != $uid) {
        echo json_encode(["status" => "error", "message" => "Bạn không thể xóa bình luận của người khác."]);
        exit;
    }

    // Xóa bình luận
    $deleteQuery = $connect->prepare("DELETE FROM comments WHERE id = ?");
    $deleteQuery->bind_param("i", $comment_id);

    if ($deleteQuery->execute()) {
        echo json_encode(["status" => "success", "message" => "Bình luận đã được xóa."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Lỗi khi xóa bình luận."]);
    }

    $deleteQuery->close();
    $connect->close();
} else {
    echo json_encode(["status" => "error", "message" => "Yêu cầu không hợp lệ."]);
}
?>