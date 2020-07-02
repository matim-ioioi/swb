<?php
    include_once('../includes/dbConnect.php');
    $login = $_COOKIE['login'];
    $price = $_POST['price'];
    $productsList = $conn->query("SELECT `cart` FROM `users` WHERE `login` = '{$login}'")->fetch_assoc()['cart'];
    $id = $conn->query("SELECT `id` FROM `users` WHERE `login` = '{$login}'")->fetch_assoc()['id'];
    if(strlen($productsList)>0) {
        $query = "INSERT INTO `orders` (`price`, `products_list`, `id_user`) VALUES ('$price', '$productsList', '$id')";
        $result = $conn->query($query);
    }
    if($result) echo true;
    else echo false;