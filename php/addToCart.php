<?php
    include_once('../includes/dbConnect.php');
    $query = "UPDATE `users` SET `cart` = CONCAT(cart, '{$_POST['idProduct']} ') WHERE `login` = '{$_COOKIE['login']}'";
    $result=$conn->query($query);
    if($result) echo true;
    else echo false;