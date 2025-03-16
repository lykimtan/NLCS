<?php
require 'connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['postbtn'])) {
    $email = $_POST['email'];
    $username = mysqli_real_escape_string($connect, strip_tags($_POST['username']));
    $password = password_hash(mysqli_real_escape_string($connect, strip_tags($_POST['password'])),PASSWORD_BCRYPT);
    $checkusername = $connect->query("Select * from  `users` where `username` = '$username'");
    $checkemail = $connect->query("Select * from  `users` where `email` = '$email'");
    if (!empty($email) && !empty($username) && !empty($password)) {
        if($checkusername->num_rows!=0) {
            echo "<p>Tên đăng nhập đã tồn tại, vui lòng nhập tên đăng nhập khác</p>";
        } else {
            $sql = "INSERT INTO `users` (`email`,`username`, `password`) VALUES ('$email', '$username', '$password')";
            if ($connect->query($sql) === TRUE) {
                    header ("Location: ../resuccess.html");
                    exit();
            } else {
                echo "Lỗi: " . $sql . " - " . $connect->error;
            }
        }
    }

}
?>

