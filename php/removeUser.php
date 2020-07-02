<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['idUser'])) {
        $id = $_POST['idUser'];
        $query = "DELETE FROM `users` WHERE `id` = \"{$id}\"";
        if($res = $conn->query($query)) echo true;
        else echo false;
    }