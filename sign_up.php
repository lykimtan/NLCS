
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
    <title>Đăng ký tài khoản</title>
</head>

<body>

    <div class="container_sign-in">

        <div class="register_content">

            <div class="register_content-item  register_content-item-left">
                <h2 class="form_title">ĐĂNG KÝ</h2>
                <form id="formreg" action="./database/signUpHandle.php" class="get-info-form" method="POST">
                    <input name="email" placeholder="Email" type="email" class="email">   
                    <input onblur="validateUsername(this)" id="username" name="username" placeholder="Tên đăng nhập" type="text" class="user_name">
                    <div class="container-input">
                      <input id="password" name="password" placeholder="Mật khẩu" type="password" class="get_password"> 
                      <span><i id='eyeicon' onclick="showpass(inputfield,this)" class="showpass fa-solid fa-eye-slash"></i></span>
                    </div>

                    <div class="container-input">
                       <input id="repassword" name="repassword" placeholder="Nhập lại mật khẩu" type="password" class="get_password">
                      <span><i id='reeyseicon' onclick="showpass(repassword,this)" class="showpass fa-solid fa-eye-slash"></i></span>
                    </div>

                    <div class="form-btn">
                    <button name="postbtn" class="get-info_btn">Đăng ký</button>
                    </div>
                </form>

            </div>


            <div class="register_content-item register_content-item-right">
                <a class="content_img" href="./index.php">
                    <img  src="./assets/img/logo.webp" alt="" class="content_img-item">
                </a>

                <div class="content_text">
                    <p class="content_text-des">Let's go <i class="fa-solid fa-shoe-prints"></i></p>
                    <h3 class="content_text-title">BE BETTER</h3>
                   
                </div>
            </div>

        </div>
    
    </div>


<script>    
    document.getElementById("formreg").addEventListener("submit", function(event) {
    let email = document.querySelector(".email").value.trim();
    let username = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();
    let repassword = document.getElementById("repassword").value.trim();
    let errorMessage = "";

    if (!email || !username || !password || !repassword) {
        errorMessage = "Hãy điền đầy đủ thông tin bạn nhé !";
    }
    else if (password !== repassword) {
        errorMessage = "Mật khẩu nhập lại của bạn không khớp";
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

<script>
        var inputfield = document.getElementById('password');
        var reinputfield = document.getElementById('repassword');

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

</script>

<script src="./assets/js/showpass.js" ></script>
<script src='./assets/js/validator.js'>

</script>

</body>
</html> 