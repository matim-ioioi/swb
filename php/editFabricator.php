<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['editID']) || isset($_POST['editName']) || isset($_POST['editBoss'])) {
        $id = $_POST['editID'];
        $arr = array(
            'name' => $_POST['editName'],
            'boss' => $_POST['editBoss']);
        $toggle = false;
        foreach($arr as $key => $elem){
            if($elem) {
                $query = "UPDATE `fabricators` SET `{$key}` = \"{$elem}\" WHERE `id` = \"{$id}\"";
                if($result = $conn->query($query)) $toggle = true;
                else $toggle = false;
            }
        }
    }
    echo $toggle;