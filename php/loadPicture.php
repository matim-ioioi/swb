<?php
    include_once("../includes/dbConnect.php");
    if(!empty($_FILES)) {
        if(is_uploaded_file($_FILES['inputPic']['tmp_name'])) {
            $source_path = $_FILES['inputPic']['tmp_name'];
            $target_path = '../pictures/avatars/' . $_FILES['inputPic']['name'];
            if (move_uploaded_file($source_path, $target_path)) {
                $conn->query("UPDATE `users` SET `picture` = \"{$_FILES['inputPic']['name']}\" WHERE `login` = \"{$_COOKIE['login']}\"");
                $conn->close();
            }
            echo true;
        }
        else echo false;
    }
    $conn->close();
?>