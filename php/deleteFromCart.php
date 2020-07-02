<?php
    include_once('../includes/dbConnect.php');
    $toggle = false;
    $query = "SELECT `cart` FROM `users` WHERE `login` = '{$_COOKIE['login']}'";
    $result = $conn->query($query);
    $arr = array();
    $cartStr = mysqli_fetch_assoc($result)['cart'];
    $arr = explode(' ', trim($cartStr));
    $query = "UPDATE `users` SET `cart` = '' WHERE `login` = '{$_COOKIE['login']}'";
    $result = $conn->query($query);
    foreach ($arr as $key => $elem) {
        if($elem == $_POST['idProduct']) {
            unset($arr[$key]);
            $toggle = true;
        }
        else {
            $query = "UPDATE `users` SET `cart` = CONCAT(cart, '{$elem} ') WHERE `login` = '{$_COOKIE['login']}'";
            $result = $conn->query($query);
        }
    }
    echo $toggle;