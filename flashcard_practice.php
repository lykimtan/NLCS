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


    //tao phan tu <li> cho bforum
    let newforumItem = document.createElement("li");
    newforumItem.className = "account-list_item";

    //tao phan tu <a> cho bforum
    let linkforum = document.createElement('a');
    linkforum.href = "createPost.php";
    linkforum.className = "account-list_item-link";
    linkforum.textContent = "Diễn đàn Bforum";

    newforumItem.appendChild(linkforum)


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
    accList.replaceChildren(newforumItem,newListItem, newPasswordItem);
     }
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
    <link rel="stylesheet" href="./assets/css/flashcard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/css/font.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Flashcard Practice</title>
</head>

<body>

  <header id="header">

    <nav>
      <div class="nav_item-container flashcard-container">
        <a href="./flashcard.php" class="nav-item">FLASHCARD</a>

        <ul class="flashcard-list">
          <li class="flashcard-list_item"><a href="./flashcard.php" class="flashcard-list_item-link">Tạo bộ Flashcard</a></li>
          <li class="flashcard-list_item"><a href="./flashcard_practice.php" class="flashcard-list_item-link">Luyện tập Flashcard</a></li>
        </ul>

      </div>
      
      <div class="nav_item-container">
        <a href="./todo_list.php" class="nav-item">TO-DO LIST</a>
      </div>
      <div class="logo">
        <a href="./index.php"> <img src="./assets/img/logo.webp" alt="" class="logo-img"></a>
      </div>

      <div class="nav_item-container">
        <a href="./podomoro.php" class="nav-item">POMODORO</a>
      </div>

      <div class="account">
        <a href="" class="nav-item user-inf">Userrr name</a>
        <img src="./assets/img/user_16111390.webp" alt="" class="acc-img">

        <ul class="account-list">
          <li class="account-list_item"><a href="./sign_in.php" class="account-list_item-link">Đăng nhập</a></li>
          <li class="account-list_item"><a href="./sign_up.php" class="account-list_item-link">Đăng ký tài khoản</a></li>
        </ul>

      </div>
    </nav>
  </header>


  <div class="container_wholeFlashcard">


    <button onclick="showMenu()" class="show_libary"><i class="fa-solid fa-book"></i></button>
    <div class="container_libary">
        <button class="close_libary" onclick="closeMenu()"><i class="fa-regular fa-circle-xmark"></i></button>
          <h2 class="libary_title"><i class="fa-solid fa-book"></i> Thư viện của tôi</h2>
          <ul class="libary_list">
            
          </ul>
    </div>

    <div class="container_flashcard">
    <div class="title_flashcard_selection">Flashcard Title</div>

      <div class="flashcard_view_container">
          <div class="flashcard_view">
            <div class="flashcard-front">
              <h2 class="content_front">Măt trước</h2>
            </div>
             
          <div class="flashcard-back">
            <h2 class="content_back">Măt sau</h2>
          </div>

          </div>
     </div>
  
      <div class="flashcard_view_control">
          <button class="control-btn back-btn">
              <i class="fa-solid fa-backward-step control_flashcard-icon"></i>
          </button>
  
          <button class="control-btn rotate">
            <i class="fa-solid fa-arrows-rotate control_flashcard-icon"></i>
          </button>
  
          <button class="control-btn foward-btn">
              <i class="fa-solid fa-forward-step control_flashcard-icon"></i>
          </button>
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
                  <p class="footer_content_item">BeBetter</p>
                  <p class="footer_content_item">Các tính năng chính</p>
                  <div class="block_img_feature">
                    <div class="img_item_feature">
                        <a href="./flashcard.php" class="feature_link"><img class="img_feature" src="http://localhost/NLCS/assets/img/flashcard_img.jpeg" alt=""></a>
                    </div>

                    <div class="img_item_feature">
                       <a href="./todo_list.php" class="feature_link"><img class="img_feature" src="http://localhost/NLCS/assets/img/to_do_list.jpeg" alt=""></a>
                    </div>
                    
                    <div class="img_item_feature">
                        <a href="./podomoro.php" class="feature_link"><img class="img_feature" src="http://localhost/NLCS/assets/img/podomoro.jpeg" alt=""></a>
                    </div>
                    
                    <div class="img_item_feature">
                       <a href="./createPost.php" class="feature_link"><img class="img_feature" src="http://localhost/NLCS/assets/img/bforum.jpeg" alt=""></a>
                    </div>
                  </div>
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
  <script src="./assets/js/flashcard-practice.js"></script>
  <script src="./assets/js/flashcard_receive.js"></script>
  <script src="./assets/js/deleteflashcard_modal.js"></script>
  <script src="./assets/js/sendemail.js"></script>

</body>
</html>