<?php
    session_start(); 
    require 'connect.php'; 

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Truy vấn database kiểm tra username
        $query = "SELECT * FROM `users` WHERE `username` = '".$connect->real_escape_string($username)."'";
        $result = $connect->query($query);
        if ($result->num_rows == 0) {
            echo "Tài khoản không tồn tại!";
        } else {
            $checkvar = $result->fetch_array(); 
            $uid = $checkvar['uid'];
            if (!password_verify($password, $checkvar['password'])) {
                echo "Sai mật khẩu";
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['uid'] = $uid; 
                header("Location: ../index.php");
                exit();
            }
        }
    }
?>