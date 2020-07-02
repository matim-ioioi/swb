<?php
    include_once('../includes/dbConnect.php');
    $query = "SELECT `cart` FROM `users` WHERE `login` = '{$_COOKIE['login']}'";
    $result = $conn->query($query);
    echo mysqli_fetch_assoc($result)['cart'];