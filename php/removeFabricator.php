<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['idFabricator'])) {
        $id = $_POST['idFabricator'];
        $query = "DELETE FROM `fabricators` WHERE `id` = \"{$id}\"";
        if($res = $conn->query($query)) echo true;
        else echo false;
    }