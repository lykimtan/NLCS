<?php 
  session_start(); 
  include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="./assets/img/logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/sign_in_up.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/css/font.css">
    <title>Document</title>
</head>

<body>

    <div class="container_sign-in">
        <div class="register_content ">
            <div class="register_content-item register_content-item-left ">
                <a class="content_img" href="./index.php">
                    <img  src="./assets/img/logo.webp" alt="" class="content_img-item">
                </a>

                <div class="content_text">
                    <p class="content_text-des">Mọi hành trình vạn dặm bắt đầu từ một bước chân <i class="fa-solid fa-shoe-prints"></i></p>
                    <h3 class="content_text-title">BE BETTER</h3>
                </div>
            </div>

            <div class="register_content-item register_content-item-right">
                <h2 class="form_title">ĐĂNG NHẬP</h2>
                <form action="./database/signInHandle.php" class="get-info-form" method="post" id="formLog">
                    <input name="username" placeholder="Tên đăng nhập" type="text" class="user_name">
                    <div class="container-input">
                      <input id="password" name="password" placeholder="Mật khẩu" type="password" class="get_password"> 
                      <span><i id='eyeicon' onclick="showpass(inputfield,this)" class="showpass fa-solid fa-eye-slash"></i></span>
                    </div>
                    <div class="form-btn">
                        <button class="get-info_btn"><a class="get-info_link" href="./sign_up.php">Đăng ký</a></button>
                        <button type="submit" name="submit" class="get-info_btn">Đăng nhập</button>
                    </div>
                    <!-- <p class="forgot_password"><a class="forgot_password-link" href="">Quên mật khẩu ?</a></p> -->
                </form>

            </div>

        </div>
    
    </div>


    <script src="./assets/js/showpass.js" ></script>
    <script>
       document.getElementById("formLog").addEventListener("submit", function(event) {
        let username = document.getElementById("username").value.trim();
        let password = document.getElementById("password").value.trim();
        let errorMessage = "";

        if (!username || !password) {
            errorMessage = "Hãy điền đầy đủ thông tin bạn nhé !";
        }
        else if (password.length < 6) {
            errorMessage = "Mật khẩu phải có ít nhất 6 ký tự";
        }
        if (errorMessage) {
            event.preventDefault(); 
            alert(errorMessage); 
    }
   });

    </script>
    
    <!-- <?php 
        // if(isset($_POST['submit'])) {
        //     $u_name =$_POST['username'];
        //     $password = $_POST['password'];
        //     $sql = "select uid, username from users where username='{$u_name}' and password = '{$password}' ";
        //     $reg=$connect->query($sql);
        //     if($reg->num_rows > 0)
        //     {
        //         $row=$reg->fetch_assoc();
        //         $_SESSION["uid"]=$row["uid"];
        //         $_SESSION["username"] = $row["username"];
        //         header("Location: index.php");
        //     }
        //     else {
        //         echo "<div>Thông tin đăng nhập sai<div>";
        //     }
        // }
     ?> -->
</body>
</html>