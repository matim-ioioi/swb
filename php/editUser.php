<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['editLogin']) || isset($_POST['editFirstName']) ||
        isset($_POST['editLastName']) || isset($_POST['editPatronymic']) ||
        isset($_POST['editPicture']) || isset($_POST['editStatus'])) {
        $id = $_POST['editID'];
        $arr = array(
            'login' => $_POST['editLogin'],
            'firstname' => $_POST['editFirstName'],
            'lastname' => $_POST['editLastName'],
            'patronymic' => $_POST['editPatronymic'],
            'picture' => $_POST['editPicture'],
            'status' => $_POST['editStatus']);
        $toggle = false;
        foreach($arr as $key => $elem){
            if($elem) {
                $query = "UPDATE `users` SET `{$key}` = \"{$elem}\" WHERE `id` = \"{$id}\"";
                if($result = $conn->query($query)) $toggle = true;
                else $toggle = false;
            }
        }
    }
    echo $toggle;