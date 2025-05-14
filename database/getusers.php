<?php 
    require('connect.php');
    $sql = "select * from users where `role` != 1";
    $result = $connect->query($sql);
?>