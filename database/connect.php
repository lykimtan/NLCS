<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "users-store-data"; 
$connect = new mysqli($host, $username, $password, $dbname);

// Kiểm tra kết nối
if ($connect->connect_error) {
    die("Kết nối không thành công!!! Lỗi: " . $connect->connect_error);
}
else {
    echo "Kết nối thành công";
}

?>