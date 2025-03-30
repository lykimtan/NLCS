<?php
include 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION["uid"])) {
    die("Bạn cần đăng nhập!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["status_input"];
    $content = $_POST["content_input"];
    $uid = $_SESSION["uid"];
    $imageName = NULL;


    if (!empty($_FILES["img_input"]["name"])) {
        $targetDir = "../assets/img_posts/"; 
        $imageName = time() . "_" . basename($_FILES["img_input"]["name"]); 
        $targetFilePath = $targetDir . $imageName;


        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "png", "jpeg", "gif"];

        if (in_array($imageFileType, $allowedTypes)) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (move_uploaded_file($_FILES["img_input"]["tmp_name"], $targetFilePath)) {
                echo "Ảnh đã được tải lên: " . $targetFilePath;
            } else {
                echo "Lỗi khi tải ảnh.";
                $imageName = NULL;
            }
        } else {
            echo "Chỉ chấp nhận file JPG, JPEG, PNG, GIF.";
            $imageName = NULL;
        }
    }

    // Nếu ảnh không tải lên thành công, không lưu đường dẫn rỗng vào DB
    if ($imageName !== NULL) {
        $sql = "INSERT INTO posts (uid, title, content, image) VALUES ('$uid', '$title', '$content', '$imageName')";
        if ($connect->query($sql) === TRUE) {
            echo "<script>

            alert('Bạn đã đăng bài viết thành công!');
            window.location.href = '../createPost.php';

            </script>";
        } else {
            echo "Lỗi SQL: " . $connect->error;
        }
    }
    
    else {
        $sql = "INSERT INTO posts (uid, title, content) VALUES ('$uid', '$title', '$content')";
        if ($connect->query($sql) === TRUE) {
            echo "<script>
            alert('Bạn đã đăng bài viết thành công!');
            window.location.href = document.referrer;
            </script>";
        } else {
            echo "Lỗi SQL: " . $connect->error;
        } 
    }
}
?>