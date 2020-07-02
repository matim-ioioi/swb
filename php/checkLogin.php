<?php
    include_once('../includes/dbConnect.php');
    $query = "SELECT * FROM `users` WHERE `login` = '{$_POST['login']}'";
    $result=$conn->query($query);
    if($result->num_rows<=0) echo true;
    else echo false;