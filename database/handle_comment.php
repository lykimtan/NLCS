<?php
require('connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['content'])) {
    $post_id = $_POST['post_id'];
    $uid = $_POST['uid'];
    $content = trim($_POST['content']);

    if (!$uid) {
        echo json_encode(["status" => "error", "message" => "Bạn cần đăng nhập để bình luận."]);
        exit;
    }

    $sql = "INSERT INTO comments (post_id, uid, content) VALUES (?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("iis", $post_id, $uid, $content);

    if ($stmt->execute()) {
        $comment_id = $stmt->insert_id; // Lấy ID của bình luận vừa chèn

        // Lấy thông tin người dùng
        $userQuery = $connect->prepare("SELECT username FROM users WHERE uid = ?");
        $userQuery->bind_param("i", $uid);
        $userQuery->execute();
        $userResult = $userQuery->get_result();
        $user = $userResult->fetch_assoc();

        echo json_encode([
            "status" => "success",
            "message" => "Bình luận đã được đăng!",
            "comment_id" => $comment_id,
            "username" => $user['username'] ?? 'Người dùng',
            "content" => htmlspecialchars($content)
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Không thể đăng bình luận."]);
    }

    $stmt->close();
    $connect->close();
}
?>