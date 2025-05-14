<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    include_once('./database/connect.php');
    $username = $_SESSION['username'] ?? 'Username'; // Kiểm tra username có tồn tại không

    $sql = "SELECT posts.id, users.username, posts.title, posts.content, posts.image, posts.created_at 
        FROM posts 
        JOIN users ON posts.uid = users.uid 
        ORDER BY posts.created_at DESC";
        $result = $connect->query($sql);
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/css/font.css">
    <link rel="stylesheet" href="./assets/css/createPost.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Trang cá nhân</title>
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
        <a href="infouser.php" class="nav-item user-inf">User's name</a>
        <img src="./assets/img/user_16111390.webp" alt="" class="acc-img">

        <ul class="account-list">
          <li class="account-list_item"><a href="./sign_in.php" class="account-list_item-link">Đăng nhập</a></li>
          <li class="account-list_item"><a href="./sign_up.php" class="account-list_item-link">Đăng ký tài khoản</a></li>
        </ul>

      </div>
    </nav>
  </header>





<div class="container_posts">
    <div class="header_forum_block">

        <div class="create_post_block">
            <button class="create-btn">
                     <i class="fa-solid fa-plus"></i>
            </button>
            Tạo bài viết mới
        </div>


        <div class="account_block">
            <a href="" class="acount-avatar_link">
                <span class="perwall">Trang cá nhân</span>
                <img class="img_avartar" src="./assets/img/avartarpost.png" alt="">
            </a>
        </div>
    </div>

  
        <?php
            $stmt = $connect->prepare("SELECT posts.id, users.username, posts.title, posts.content, posts.image, posts.created_at 
            FROM posts 
            JOIN users ON posts.uid = users.uid 
            WHERE users.uid = ? 
            ORDER BY posts.created_at DESC");
                $stmt->bind_param("i", $_SESSION['uid']);
                $stmt->execute();
                $result = $stmt->get_result();
            ?>

            <div class="container_forum_block">
                <div class="logo_forum">
                    <a href="./createPost.php"><img class="forum_logo" src="./assets/img/forum_logo.png" alt=""></a>
                    <h2 class="logo_title"><?php echo  $_SESSION['username'] ;?></h2>
                </div>

                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="container_post">
                        <div class="info_upost">
                            <div class="contain_img_u">
                                <img src="./assets/img/avartarpost.png" alt="" class="img_user">
                            </div>

                            <div class="contain_ifopost">
                                <h3 class="uname"><?php echo htmlspecialchars($row['username']); ?></h3>
                                <p class="datetime">Thời điểm đăng: <?php echo date("d/m/Y", strtotime($row['created_at'])); ?></p>
                            </div>

                            <div class="edit_post_area">
                               <form action="./database/handle_post.php" method="POST" class="delete-form">
                                      <input type="hidden" name='delete_id' value="<?php echo $row['id'];?>">
                                      <button onclick="showDeleteModal(this)"  type='button' name='delete' class='delete_btn' >
                                          <i class="fa-solid fa-trash"></i> Xoá
                                      </button>
                               </form>

                               <button class='edit-btn' type='button' onclick='openEditModal(
                                          "<?php echo $row['id']; ?>", 
                                          "<?php echo htmlspecialchars($row['title']); ?>", 
                                          "<?php echo htmlspecialchars($row['content']); ?>"
                                      )'>
                                          <i class='fa-solid fa-pen-to-square'></i> Sửa
                                </button>
                            </div>

                            <!-- Modal Xác nhận Xóa -->
                                <div id="deleteModal" class="modal">
                                    <div class="modal-content">
                                        <p>Bạn có chắc chắn muốn xóa bài viết này không?</p>
                                        <div class="modal-buttons">
                                            <button id="confirmDelete">Xác nhận</button>
                                            <button id="cancelDelete">Hủy bỏ</button>
                                        </div>
                                    </div>
                                </div>
                              <!-- Kết thúc modal -->
                        </div>

                        <div class="main_contain_post">
                            <div class="contain_title_post">
                                <p class="title_post"><?php echo htmlspecialchars($row['title']); ?></p>
                            </div>
                            <div class="contain_img_post">
                                <?php if (!empty($row['image'])) { ?>
                                    <img class="img_post" src="./assets/img_posts/<?php echo htmlspecialchars($row['image']); ?>" alt="Post Image">
                                <?php } ?>
                            </div>
                            <div class="contain_title_post">
                                <p class="title_post"><?php echo htmlspecialchars($row['content']); ?></p>
                            </div>

                            <div class="contain_comment">
                                <h2 class="comment_title">COMMENT</h2>

                                <div id="comment_list_<?= $row['id'] ?>" class="contain_content_comment">
                                    <?php
                                        $post_id = $row['id'];
                                        $comment_sql = "SELECT comments.id, comments.content, comments.uid, users.username, comments.created_at 
                                                        FROM comments 
                                                        JOIN users ON comments.uid = users.uid 
                                                        WHERE comments.post_id = ? 
                                                        ORDER BY comments.created_at DESC";
                                        $stmt = $connect->prepare($comment_sql);
                                        $stmt->bind_param("i", $post_id);
                                        $stmt->execute();
                                        $comments_result = $stmt->get_result();

                                        while ($comment = $comments_result->fetch_assoc()) {
                                        ?>
                                            <div class="comment-item" id="comment_<?= $comment['id'] ?>">
                                                <div class="comment_time_user">
                                                    <span class="comment_username"><strong><?php echo htmlspecialchars($comment['username']); ?>:</strong></span>
                                                    <span class="time_comment"><?php echo date("H:i d/m/Y", strtotime($comment['created_at']));?></span>
                                                </div>
                                                <div class="comment_content_block">
                                                    <span class="content_comment"><?php echo htmlspecialchars($comment['content']); ?></span>
                                                </div>
                                                
                                  
                                                    <button onclick="deleteComment(<?= $comment['id'] ?>)" class="delete-btn delete_btn_comment">
                                                        <i class="fa-solid fa-delete-left"></i>
                                                    </button>
                                            
                                            </div>
                                    <?php } ?>
                                </div>

                                <form class="input_comment" onsubmit="postComment(event, <?= $row['id'] ?>)">
                                    <input type="hidden" name="post_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" name="uid" value="<?= $_SESSION['uid'] ?? '' ?>">
                                    <input name="content" placeholder="Nhập bình luận ..." type="text" class="input_coment_item" required>
                                    <input class="sbcomment" type="submit" value="Đăng">
                               </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

    </div>


</div>


      <div class="overlay">

        <div class="container_create_post">
        
            <h1>Tạo bài viết mới</h1>
            <form method="POST" id="form_create_post" action="./database/upload_post.php" class="post_posts" enctype="multipart/form-data">
                
                <div class="status_contain">
                    <label for="status_input">Tiêu đề bài viết</label>
                    <input id="status_input" name="status_input" type="text" placeholder="Nhập tiêu đề bài viết">
                </div>
        
                <div class="img_contain">
                <label for="img_input">Thêm ảnh</label>
                <input id='img_input'  type="file" name="img_input" accept="image/*" id="img_input">
                </div>
        
                <div class="content_contain">
                    <label for="">Nội dung bài viết</label>
                    <textarea id="content_input" type="text" name="content_input"></textarea>
                </div>
        
                <div class="button_contain">
                    <button id='uploadPost_btn' type="button">Đăng bài</button>
                    <button id="cancelBtn" type='submit'>Huỷ bỏ</button>
                </div>
        
            </form> 
        
        </div>


      </div>


  <!-- Footer -->

  <div class="over_lay_edit">
    <div id="editPostModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()"></span>
            <h2 class="title_edit_form">Chỉnh sửa bài viết</h2>
            <form id="editPostForm" method="POST" action="./database/editPost.php">
                <input type="hidden" id="editPostId" name="post_id">
                
                <label for="editTitle">Tiêu đề</label>
                <input type="text" id="editTitle" name="title">
    
                <label for="editContent">Nội dung</label>
                <textarea id="editContent" name="content"></textarea>
    
                <button type="submit">Cập nhật</button>
            </form>
        </div>
    </div>

  </div>



</body>
<script src="./assets/js/script.js"></script>
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
<script>
       
    let createbtn = document.querySelector('.create-btn');
    let container_createPost = document.querySelector('.overlay');
    document.getElementById("cancelBtn").addEventListener("click", function(e) {
        document.getElementById("status_input").value = "";
        document.getElementById("img_input").value = "";
        document.getElementById("content_input").value = "";
        container_createPost.style.display = "none"
        e.preventDefault();
    });


    createbtn.addEventListener("click", function() {
        if (container_createPost.style.display === "none" || container_createPost.style.display === "") {
            container_createPost.style.display = "flex";
        } else {
            container_createPost.style.display = "none";
        }
    });




</script>

<script src="./assets/js/handle_modal.js"></script>

<script>
  function postComment(event, postId) {
    event.preventDefault(); // Ngăn chặn tải lại trang

    let form = event.target;
    let formData = new FormData(form);

    fetch("./database/handle_comment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            // Tạo bình luận mới và thêm vào danh sách
            let commentList = document.getElementById("comment_list_" + postId);
            let newComment = document.createElement("div");
            newComment.classList.add("comment-item");
            newComment.setAttribute("id", "comment_" + data.comment_id);
            newComment.innerHTML = `
                <span class="comment_username"><strong>${data.username}:</strong></span>
                <span class="content_comment">${data.content}</span>
                <button onclick="deleteComment(${data.comment_id})" class="delete-btn delete_btn_comment">
                    <i class="fa-solid fa-delete-left"></i>
                </button>
            `;
            commentList.prepend(newComment); // Thêm vào đầu danh sách

            form.reset(); // Xóa nội dung trong ô nhập
            Swal.fire({
                title: "Đăng bình luận thành công!",
                icon: "success",
              });
        } else {
            alert("Lỗi: " + data.message);
        }
    })
    .catch(error => console.error("Lỗi:", error));
}
</script>


<script>
  function deleteComment(commentId) {
    Swal.fire({
        title: "Bạn có chắc chắn muốn xóa bình luận này?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./database/delete_comment_per.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "comment_id=" + commentId
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    document.getElementById("comment_" + commentId).remove();
                    Swal.fire("Đã xóa!", "Bình luận đã được xóa.", "success");
                } else {
                    Swal.fire("Lỗi!", data.message, "error");
                }
            })
            .catch(error => {
                Swal.fire("Lỗi hệ thống!", "Vui lòng thử lại sau.", "error");
                console.error("Lỗi:", error);
            });
        }
    });
}
</script>
<script src="./assets/js/createPost_validate.js"></script>
<script src="./assets/js/sendemail.js"></script>

</html>