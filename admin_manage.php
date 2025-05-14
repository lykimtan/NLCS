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
    <link rel="shortcut icon" href="./assets/img/adminown.jpeg" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="./assets/css/font.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/adminpage.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Admin Page</title>
</head>

<body>

    <div class="container">

        <div class="main_contain">

            <div class="header_page">

                <div class="header_item">
                   <h1 class="title_header">
                        ADMIN
                   </h1>
                </div>

                <div class="header_item">
                    <img class="img_admin" src="./assets/img/adminown.jpeg" alt="">
                </div>

                <div class="header_item">
                    <h1 class="title_header">
                        BeBETTER
                   </h1>
                </div>

            </div>

            <hr>

            <div class="body_page">

                <h1 class="title_body">QUẢN LÝ TÀI KHOẢN NGƯỜI DÙNG</h1>

                <div class="container_table_info">

                    <table>
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Email</th>
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php 
                                include './database/getusers.php' ;
                                if($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "
                                            <tr class='tr_item' id='row_{$row['uid']}'>
                                                <td>{$row['uid']}</td>
                                                <td>{$row['username']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['ND_NgayTaoTK']}</td>
                                                <td>
                                                  <button onclick='confirmDelete({$row['uid']})' class='delete-btn'>
                                                        <i class='fa-solid fa-trash'></i> Xoá
                                                  </button>
                                                </td>
                                            </tr>";
                                    }
                                }
                            ?>
                    </tbody>
                    </table>

                </div>

            </div>



            <div class="contain_getout">
                <button class="btn_logout_admin">Thoát khỏi chức năng quản trị</button>
            </div>

        </div>

    </div>

</body>

<script>
function confirmDelete(userId) {
    console.log(userId)
    Swal.fire({
        title: "Bạn có chắc chắn muốn xoá người dùng này không?",
        text: "Hành động này không thể hoàn tác!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy"
    }).then((result) => {
        if (result.isConfirmed) {
            fetch("./database/delete_user.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `delete=1&delete_id=${userId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    Swal.fire("Xóa thành công!", data.message, "success");
                    document.getElementById("row_" + userId).remove();
                } else {
                    Swal.fire("Lỗi!", data.message, "error");
                }
            })
        }
    });
}


document.querySelector('.btn_logout_admin').addEventListener('click', function() {
        Swal.fire({
            title: 'Bạn có chắc chắn muốn đăng xuất khỏi tài khoản quản trị không ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Đồng ý',
            cancelButtonText: 'Hủy bỏ'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = './database/logout.php';
            }
        });
    });

</script>
</html>