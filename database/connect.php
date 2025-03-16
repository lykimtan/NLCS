<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users-store-data"; 
$connect = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($connect->connect_error) {
    die("Kết nối không thành công!!! Lỗi: " . $connect->connect_error);
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $users = $connect->query("Select * from `users` where `username` = '$username' ")->fetch_array();
}

?>