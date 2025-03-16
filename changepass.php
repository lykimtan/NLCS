<?php
    include_once('./database/connect.php');
    if(isset($_POST['submit'])) {
        $oldpassword = $_POST['oldpass'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        $query = "SELECT * FROM `users` WHERE `username` = '".$connect->real_escape_string($username)."'";
        $result = $connect->query($query);
        $checkvar = $result->fetch_array();

        if (!password_verify($oldpassword, $checkvar['password'])) {
            echo "Sai mật khẩu";
        }
        else {
            $hash = password_hash($password,PASSWORD_BCRYPT);
            $connect->query("UPDATE `users` set `password` = '$hash' where username = '".$_SESSION["username"]."' ");
            echo '<script>alert("Thay đổi mật khẩu thành công! ")</script>';
            header("Location: index.php");
        }

       
    }
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
                    <p class="content_text-des">Sự sẵn sàng không phải là cảm giác, nó là sự lựa chọn<i class="fa-solid fa-shoe-prints"></i></p>
                    <h3 class="content_text-title">BE BETTER</h3>
                </div>
            </div>

            <div class="register_content-item register_content-item-right">
                <h2 class="form_title">Đổi mật khẩu</h2>
                <form action="" class="get-info-form" method="post" id="changepass">
                    <input name="oldpass" id="oldpass" placeholder="Mật khẩu hiện tại" type="text" class="user_name">
                    <div class="container-input">
                      <input id="password" name="password" placeholder="Mật khẩu mới" type="password" class="get_password"> 
                      <span><i id='eyeicon' onclick="showpass(password,this)" class="showpass fa-solid fa-eye-slash"></i></span>
                    </div>
                    <div class="container-input">
                        <input id="repassword" name="repassword" placeholder="Nhập lại mật khẩu mới" type="password" class="get_password"> 
                        <span><i id='eyeicon' onclick="showpass(repassword,this)" class="showpass fa-solid fa-eye-slash"></i></span>
                    </div>

                    <div class="form-btn">
                        <button type="submit" name="submit" class="get-info_btn">Xác nhận</button>
                    </div>
                </form>

            </div>

        </div>
    
    </div>
    <script>
         function showpass(element,icon) {
           if(element.type === 'password')
           {
               element.type = 'text';
               icon.classList.remove('fa-eye-slash');
               icon.classList.add('fa-eye');
       
           }
           else {
               element.type ='password';
               icon.classList.remove('fa-eye');
               icon.classList.add('fa-eye-slash');
           }
       }

            document.getElementById('changepass').addEventListener('submit', function(event) {
            var getpass = document.getElementById('password');
            var getrepass = document.getElementById('repassword');
            var getoldpass = document.getElementById('oldpass');
            var error = '';

            if (!getoldpass.value.trim() || !getpass.value.trim() || !getrepass.value.trim()) {
                error = 'Điền đầy đủ thông tin để đổi mật khẩu!';
            } else if (getpass.value.trim() !== getrepass.value.trim()) {
                error = 'Mật khẩu nhập lại không khớp';
                getrepass.focus();
            }

            if (error) {
                alert(error);
                event.preventDefault();
            }
            });

   
    </script>


</body>
</html>