<?php
    include_once("../includes/dbConnect.php");
    $toggle = false;
    if(isset($_POST['editPicture']) || isset($_POST['editPrice']) || isset($_POST['editSizes']) || isset($_POST['editID'])) {
        $id = $_POST['editID'];
        $arr = array(
            'picture' => $_POST['editPicture'],
            'price' => $_POST['editPrice'],
            'sizes' => $_POST['editSizes']);
        foreach($arr as $key => $elem){
            if($elem) {
                $query = "UPDATE `products` SET `{$key}` = \"{$elem}\" WHERE `id` = \"{$id}\"";
                if($result = $conn->query($query)) $toggle = true;
                else $toggle = false;
            }
        }
    }
    echo $toggle;