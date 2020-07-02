<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['idProduct'])) {
        $id = $_POST['idProduct'];
        $query = "DELETE FROM `products` WHERE `id` = \"{$id}\"";
        if($res = $conn->query($query)) echo true;
        else echo false;
    }