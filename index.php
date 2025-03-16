
<?php
    session_start();
    include_once('./database/connect.php');
    $username = $_SESSION['username'] ?? 'Username'; // Kiểm tra username có tồn tại không
?>

<script>

  
document.addEventListener("DOMContentLoaded", function () {
    let username = "<?php echo addslashes($username); ?>";
    if(username!='Username') {
      alert("Xin chào, " + username);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/css/font.css">
    <title>Trang chủ</title>
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
        <a href="#"> <img src="./assets/img/logo.webp" alt="" class="logo-img"></a>
      </div>

      <div class="nav_item-container">
        <a href="./podomoro.php" class="nav-item">POMODORO</a>
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

  <div class="container_home">

    <div class="content">
      <div class="content-text">
          <h1 class="text-content_title">Active recall là gì ?</h1>
          <p class="text-content_description">
            Active Recall (Gợi nhớ chủ động) là một kỹ thuật học tập hiệu quả,
             giúp bạn ghi nhớ và hiểu sâu kiến thức hơn bằng cách buộc não bộ tự 
             nhớ lại thông tin thay vì chỉ đọc hoặc ghi chú thụ động. Đây là cách 
             học được nhiều nhà nghiên cứu đánh giá là tốt nhất cho việc ghi nhớ 
             dài hạn.
             <br>
             <br>
                 <span>Lợi ích của Active Recall:</span>
             <br>
                <span class="text-content_description-list"> <i class="fa-solid fa-check"></i> Tăng khả năng ghi nhớ lâu dài.</span>
            <br>
                <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Giúp bạn phát hiện điểm yếu trong kiến thức sớm.</span>
            <br>
              <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Hiệu quả hơn nhiều so với chỉ đọc đi đọc lại.</span> 
            <br>
            <br>

            Áp dụng ngay phương pháp học Active Recall với công cụ 
            <a class="link_inner-content" href="#">
              <i class="fa-regular fa-hand-point-right"></i> Flashcard <i class="fa-regular fa-hand-point-left"></i>
            </a>
          </p>
      </div>
      <div class="content-img">
        <img class="img-content"  src="./assets/img/activerecall.webp" alt="">
      </div>
    </div>


    <div class="content">
      <div class="content-text">
          <h1 class="text-content_title">Quản lý thời gian hiệu quả với To-do List</h1>
          <p class="text-content_description">
            To-Do List là danh sách các công việc cần làm, giúp bạn quản lý và sắp xếp công việc
             một cách hiệu quả. Nó có thể được viết trên giấy, trong ứng dụng điện thoại hoặc máy 
             tính. Mỗi mục trong danh sách thường là một nhiệm vụ cụ thể kèm theo ô để đánh dấu 
             khi hoàn thành.
             <br>
             <br>
                 <span>Lợi ích của To-Do List:</span>
             <br>
                <span class="text-content_description-list"> <i class="fa-solid fa-check"></i> Quản lý thời gian tốt hơn: Giúp bạn biết rõ mình cần làm gì và khi nào làm.</span>
            <br>
                <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Tăng năng suất: Ưu tiên các công việc quan trọng và hoàn thành từng bước một.</span>
            <br>
              <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Giảm căng thẳng: Khi mọi thứ được ghi ra, bạn không phải lo quên việc.</span>
              <br>
            <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Theo dõi tiến độ: Đánh dấu các nhiệm vụ hoàn thành mang lại cảm giác thành công.</span>
            <br>
            <br>
           Tạo ngay List công việc với
            <a class="link_inner-content" href="#">
              <i class="fa-regular fa-hand-point-right"></i> To-do list <i class="fa-regular fa-hand-point-left"></i>
            </a>
          </p>
         
      </div>
      <div class="content-img">
        <img class="img-content"  src="./assets/img/to-do_list.webp" alt="">
      </div>
    </div>

    <div class="content">
      <div class="content-text">
          <h1 class="text-content_title">Nâng cao hiệu suất học tập với Pomodoro</h1>
          <p class="text-content_description">
            Kỹ thuật Pomodoro là một phương pháp quản lý thời gian được phát triển bởi Francesco Cirillo vào cuối những năm 1980.
             Nó giúp cải thiện sự tập trung và hiệu suất làm việc thông qua việc chia nhỏ thời gian làm việc thành các khoảng ngắn,
              thường là 25 phút, gọi là "Pomodoros", xen kẽ với các khoảng nghỉ ngắn
             <br>
             <br>
                 <span>Lợi ích của Pomodoro:</span>
             <br>
                <span class="text-content_description-list"> <i class="fa-solid fa-check"></i> Tăng cường tập trung: Giúp bạn duy trì sự tập trung cao độ mà không cảm thấy quá tải.</span>
            <br>
                <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Giảm mệt mỏi: Nghỉ ngắn giúp giảm căng thẳng và mệt mỏi.</span>
            <br>
              <span class="text-content_description-list"><i class="fa-solid fa-check"></i> Quản lý thời gian: Phương pháp khoa học giúp quản lý thời gian hiệu quả hơn.</span>
              <br>
              <span class="text-content_description-list"><i class="fa-solid fa-check"></i>Giảm trì hoãn: Dễ dàng bắt đầu và hoàn thành nhiệm vụ.</span>
            <br>
            Thực hành ngay với
            <a class="link_inner-content" href="#">
              <i class="fa-regular fa-hand-point-right"></i> Podomoro Technique <i class="fa-regular fa-hand-point-left"></i>
            </a>
          </p>
      </div>
      <div class="content-img">
        <img class="img-content"  src="./assets/img/podomoro.webp" alt="">
      </div>
    </div>

    <div class="content">
      <div class="content-text">
          <h1 class="text-content_title">Đường cong lãng quên và Space repetition</h1>
          <p class="text-content_description">
            <b><i>Spaced Repetition</i></b> (Ôn tập ngắt quãng) là phương pháp học tập giúp bạn ghi nhớ thông tin
            lâu hơn bằng cách ôn tập kiến thức nhiều lần với khoảng cách thời gian tăng dần giữa các 
            lần ôn.
            Phương pháp này đã được chứng minh là hiệu quả hơn nhiều so với việc học dồn (cramming) 
            hoặc ôn tập không có kế hoạch.
             <br>
             <br>
             <b><i>Đường cong lãng quên</i></b> (Ebbinghaus Forgetting Curve) là biểu đồ thể hiện tốc độ con người
             quên đi thông tin theo thời gian nếu không được ôn tập lại.Khái niệm này được nhà tâm lý học 
             người Đức Hermann Ebbinghaus đưa ra vào năm 1885, sau khi ông tự thực hiện nhiều thí nghiệm ghi
             nhớ và quên các chuỗi từ vô nghĩa.

          </p>
      </div>
      <div class="content-img">
        <img class="img-content"  src="./assets/img/spaced_repetition.webp" alt="">
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


</body>
</html>