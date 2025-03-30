<?php
include 'connect.php';
session_start();

if (!isset($_SESSION["uid"])) {
    die("Bạn cần đăng nhập!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $comment_id = $_POST['comment_id'];
    $uid = $_SESSION['uid'];

    $check_sql = "SELECT * FROM comments WHERE id = ? AND uid = ?";
    $stmt = $connect->prepare($check_sql);
    $stmt->bind_param("ii", $comment_id, $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $delete_sql = "DELETE FROM comments WHERE id = ?";
        $stmt = $connect->prepare($delete_sql);
        $stmt->bind_param("i", $comment_id);
        if ($stmt->execute()) {
            echo "<script>
            alert('Xóa bình luận thành công!');
            window.location.href = document.referrer; 
        </script>";
        } else {
            echo "Lỗi khi xóa bình luận.";
        }
    } else {
        echo "Bạn không có quyền xóa bình luận này!";
    }
}
?>