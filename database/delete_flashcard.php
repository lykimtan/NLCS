<?php
require 'connect.php';
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_POST['setname'])) {
        die("Thiếu dữ liệu!");
    }

    $setname = $_POST['setname'];
    $stmt = $connect->prepare("DELETE FROM flashcard_sets WHERE fset_name = ?");
    $stmt->bind_param("s", $setname);

    if ($stmt->execute()) {
        echo "<script>
             window.location.href = document.referrer; 
        </script>";
    } else {
        echo "<script>
            alert('Lỗi khi xoá flashcard!');
            window.location.href = document.referrer;
        </script>";
    }
}
?>
