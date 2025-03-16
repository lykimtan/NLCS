
<?php
    session_start();
    include_once('./database/connect.php');
    $username = $_SESSION['username'] ?? 'Username'; // Kiểm tra username có tồn tại không
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let username = "<?php echo addslashes($username); ?>";
    if(username!='Username') {
    let userInfo = document.querySelector(".user-inf");
    if (userInfo) {
      let accList = document.querySelector(".account-list");
    userInfo.innerText = username;

    // Tạo phần tử <li> cho Đăng xuất
    let newListItem = document.createElement("li");
    newListItem.className = "account-list_item";

    // Tạo phần tử <a> cho Đăng xuất
    let newLink = document.createElement("a");
    newLink.href = "./database/logout.php";
    newLink.className = "account-list_item-link";
    newLink.textContent = "Đăng xuất";

    // Thêm <a> vào <li>
    newListItem.appendChild(newLink);

     // Tạo phần tử <li> cho Đổi mật khẩu
     let newPasswordItem = document.createElement("li");
    newPasswordItem.className = "account-list_item";

    // Tạo phần tử <a> cho Đổi mật khẩu
    let newLinkPass = document.createElement("a");
    newLinkPass.href = "changepass.php"; 
    newLinkPass.className = "account-list_item-link";
    newLinkPass.textContent = "Đổi mật khẩu";

    // Thêm <a> vào <li>
    newPasswordItem.appendChild(newLinkPass);

    // Xóa tất cả nội dung cũ và thêm hai mục mới
    accList.replaceChildren(newListItem, newPasswordItem);
    }

    }
    else {
      document.getElementById('break').disabled = true;
      document.getElementById('session').disabled = true;
    }
   

   
});
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="./assets/img/logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/home.css">
    <link rel="stylesheet" href="./assets/css/pomodoro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/css/font.css">
    <link rel="stylesheet" href="./assets/css/toast.css">
    <title>Document</title>
</head>

<body>

  <header id="header">

    <nav>
      <div class="nav_item-container flashcard-container">
        <a href="./flashcard.html" class="nav-item">FLASHCARD</a>

        <ul class="flashcard-list">
          <li class="flashcard-list_item"><a href="./flashcard.html" class="flashcard-list_item-link">Tạo bộ Flashcard</a></li>
          <li class="flashcard-list_item"><a href="./flashcard_practice.html" class="flashcard-list_item-link">Luyện tập Flashcard</a></li>
        </ul>

      </div>
      <div class="nav_item-container">
        <a href="./todo_list.html" class="nav-item">TO-DO LIST</a>
      </div>
      <div class="logo">
        <a href="./index.php"> <img src="./assets/img/logo.webp" alt="" class="logo-img"></a>
      </div>

      <div class="nav_item-container">
        <a href="./podomoro.html" class="nav-item">POMODORO</a>
      </div>

      <div class="account">
        <a href="" class="nav-item user-inf">User's name</a>
        <img src="./assets/img/user_16111390.webp" alt="" class="acc-img">

        <ul class="account-list">
          <li class="account-list_item"><a href="./sign_in.php" class="account-list_item-link">Đăng nhập</a></li>
          <li class="account-list_item"><a href="./sign_up.php" class="account-list_item-link">Đăng ký tài khoản</a></li>
        </ul>

      </div>
    </nav>
  </header>

  <div class="container_pomodoro">
    <div class="container_pomodoro-item">

        <div class="container_pomodoro-last">
            <div class="timer-box">
                <h2 class="timer-box-title">Phiên</h2>
               <audio controls src="./assets/sound/5-second-countdown-with-sound-effect_KSUi0kN.mp3"></audio>
                <div class="timer-primary">
                    25 : 00
                </div>
    
                <div class="timer-control">
                    <button class="timer-control-btn start-btn">Bắt đầu</button>
                    <button class="timer-control-btn pause-btn">Tạm dừng</button>
                    <button class="timer-control-btn resume-btn">Tiếp tục</button>
                </div>
            </div>
    
            <div class="timer-modify">
                
                <div class="modify-item">
                    <div class="modify-display">
                      <input min="1" max="20" type="number" id="break"  class="modify-show modify-show-break"></input>
                    </div>
                    <p class="modify-title">Break length</p>
                </div>
    
                <div class="modify-item">
                    <div class="modify-display">
                        <input min="5" max="60" type="number" id="session" class="modify-show modify-show-session"></input>
                    </div>
                    <p class="modify-title">Session length</p>
                </div>
    
            </div>
        </div>

    </div>
        
  </div>

  <div id="toast">
    <div class="toast toast--prompt">
      <div class="toast__icon">
        <i class="fa-solid fa-chalkboard-user"></i>
      </div>
  
      <div class="toast__body">
         <h3 class="toast__tittle">Mẹo</h3>
         <p class="toast__msg">Để đạt hiệu quả cao nhất, hãy tắt điện thoại và để xa tầm với bạn nhé</p>
      </div>
  
      <div id="close-toast" class="toast__close">
        <i class="fa-solid fa-x"></i>
      </div>
    </div>
  </div>



  <!-- Footer -->

  <footer>
    <div class="footer-pre">

      <form action="" class="footer-form">
      
        <label class="label-letter" for="letter">Newsletter</label>
        <div class="input-box">
          <input class="input-letter" placeholder="Your message" name="letter" type="text">
          <button class="input-letter-btn"><i class="fa-regular fa-paper-plane" style="color: #74C0FC;"></i></button>
        </div>

      </form>
            
    </div>

    <div class="footer-container">
      <div class="footer_content">

          <div class="footer_content-item">
            <h2 class="footer_content-title">Thông tin trang web</h2>
            <div class="footer_content_block">
              
              <div class="footer_content_block-img">
                <img class="footer_content_block-img-item" src="./assets/img/logo.webp" alt="">
              </div>

              <div class="footer_content_block-text">

              </div>


            </div>
          </div>

          <div class="footer_content-item">
            <h2 class="footer_content-title">Thông tin liên hệ</h2>
            <ul class="footer_content-info-list">
              <li class="footer_content-info-item">
                 <a target="_blank" href="https://www.facebook.com/lykimtanjjj">
                  <i class="fa-brands fa-facebook"></i>
                </a>
              </li>

              <li class="footer_content-info-item">
                 <a href="https://www.instagram.com/"><i class="fa-brands fa-instagram"></i></a>
              </li>
              <li class="footer_content-info-item">
                 <a href="https://github.com/"><i class="fa-brands fa-github"></i></a>
              </li>
            </ul>

            <ul class="footer_content-info-writer">
              <li class="footer_content-info-writer-item">Họ tên: Lý Kim Tân</li>
              <li class="footer_content-info-writer-item">Mã số sinh viên: B2205905</li>
            </ul>
          </div>
      </div>
    </div>
  </footer>

<script src="./assets/js/pomodoro.js"></script>
<script src="./assets/js/toast.js"></script>
</body>
</html>