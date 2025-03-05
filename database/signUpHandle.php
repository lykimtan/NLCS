<?php
require 'connect.php';

if (isset($_POST['postbtn'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
      
        $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$password')";

        if ($connect->query($sql) === TRUE) {
            echo "Cập nhật bảng thành công!";
        } else {
            echo "Lỗi: " . $sql . " - " . $connect->error;
        }
    } else {
        echo "Bạn cần nhập đầy đủ thông tin trước khi đăng ký!";
    }
}
?>