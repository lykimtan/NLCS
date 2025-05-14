<?php
require('connect.php');
if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    $sql = "DELETE FROM users WHERE uid = ?";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Xóa thành công!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Xóa thất bại!"]);
    }

    $stmt->close();
    $connect->close();
}
?>