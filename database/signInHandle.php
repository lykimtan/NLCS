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
            echo "<script>alert('Tài khoản không tồn tại');
                  window.history.back();
            </script>";
        } else {
            $checkvar = $result->fetch_array(); 
            $uid = $checkvar['uid'];
            $email = $checkvar['email'];
            $nttk = $checkvar['ND_NgayTaoTK'];
            $role = $checkvar['role'];
            if (!password_verify($password, $checkvar['password'])) {
                echo "<script>alert('Mật khẩu không đúng');
                         window.history.back();
                 </script>";
            } else {
                if($role == 1) {
                    header("Location: ../admin_manage.php");
                }
                else {
                    $_SESSION['username'] = $username;
                    $_SESSION['uid'] = $uid; 
                    $_SESSION['email'] = $email;
                    $_SESSION['ND_NgayTaoTK'] = $nttk;
    
                        // Truy vấn đếm số lượng bài viết của người dùng
                        $postQuery = "SELECT COUNT(`id`) AS post_count FROM `posts` WHERE `uid` = ?";
                        $stmt = $connect->prepare($postQuery);
                        $stmt->bind_param("i", $uid);
                        $stmt->execute();
                        $postResult = $stmt->get_result();
                        $postCount = $postResult->fetch_assoc()['post_count'];
                        $_SESSION['post_count'] = $postCount;
                        $stmt->close();
    
    
                         // Truy vấn đếm số lượng Flashcard Sets của người dùng
                        $flashcardQuery = "SELECT COUNT(DISTINCT `fset_name`) AS flashcard_count FROM `flashcard_sets` WHERE `uid` = ?";
                        $stmt = $connect->prepare($flashcardQuery);
                        $stmt->bind_param("i", $uid);
                        $stmt->execute();
                        $flashcardResult = $stmt->get_result();
                        $flashcardCount = $flashcardResult->fetch_assoc()['flashcard_count'];
                        $_SESSION['flashcard_count'] = $flashcardCount;
                        $stmt->close();
    
    
                    header("Location: ../index.php");
                    exit();
                }
            }
        }
    }
?>