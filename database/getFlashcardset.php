<?php
    session_start();
    require 'connect.php'; 

    $user_id = $_SESSION['uid'];

    $sql = "select fs.fset_id, fs.fset_name, fs.fset_mota, fc.fcard_id, fc.fcard_ndmattren, fc.fcard_ndmatduoi
            from flashcard_sets fs join flashcard fc on fs.fset_id  = fc.fset_id
            where fs.uid = ?
            order by fs.fset_id, fc.fcard_id";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $flashcardData = [];
    while($row = $result->fetch_assoc())
        {
            $set_id = $row['fset_id'];
            if(!isset($flashcardData[$set_id])) {
                $flashcardData[$set_id] = [
                    'id' => $row['fset_id'],
                    'name' => $row['fset_name'],
                    'descr' => $row['fset_mota'],
                    'flashcard' => []
                ];
            }

            if($row['fcard_id'] != NULL) {
                $flashcardData[$set_id]['flashcard'][] = [
                    'id' => $row['fcard_id'],
                    'front' => $row['fcard_ndmattren'],
                    'back' => $row['fcard_ndmatduoi'],
                ];
            }
        }

     echo json_encode(array_values($flashcardData));

?>