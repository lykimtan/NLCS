<?php
    session_start();
    require "./database/connect.php";
    if($_SERVER["REQUEST_METHOD"]=="POST") {
       
        $user_id = $_SESSION['uid'] ?? NULL;
        $title = $_POST['title'] ?? "";
        $descr = $_POST['descr'] ?? "";
        $cards = json_decode($_POST['cards'],true);
        if(!$user_id){
            echo "Vui lòng đăng nhập để tạo Flashcard";
            exit;
        }
        if(!$user_id || empty($title)|| empty($descr)||empty($cards)){
            echo "Thông tin không hợp lệ";
            exit;
        }

        //luu flashcardset
        $stmt = $connect->prepare("INSERT INTO FLASHCARD_SETS (uid, fset_name, fset_mota) values (?,?,?)");
        $stmt->bind_param("iss", $user_id, $title, $descr);
        $stmt->execute();
        $flashcardset_id = $stmt->insert_id;


        //luu flashcard
        $stmt = $connect->prepare("INSERT INTO FLASHCARD (fset_id,fcard_ndmattren, fcard_ndmatduoi) values (?,?,?)");
        foreach($cards as $card) {
            $stmt->bind_param("iss",$flashcardset_id,$card['front'],$card['back']);
            $stmt->execute();
        }
        $stmt->close();
        echo "Lưu thành công";
    }
?>
