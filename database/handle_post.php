<?php
    include 'connect.php';
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

        $id = $_POST['delete_id'];

        $sql = "Delete from posts where id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            echo "<script>alert('Xoá bài viết thành công')</script>";
            header("Location: ../personalAccount.php");
        } else {
            echo"<script>alert('Lỗi không xoá được bài viết')</script>";
        }
    

?>