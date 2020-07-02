<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        $password = md5($password."qwerty");
        $query = "SELECT * FROM `users` WHERE `login` = \"{$login}\" AND `password` = \"{$password}\"";
        $result = $conn->query($query);
        if($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            setcookie('login', $user['login'], time()+3600,"/");
            setcookie('firstname', $user['firstname'], time()+3600,"/");
            setcookie('lastname', $user['lastname'], time()+3600,"/");
            if($user['patronymic']) setcookie('patronymic', $user['patronymic'], time()+3600,"/");
            setcookie('status', $user['status'], time()+3600,"/");
            echo true;
        }
        else echo false;
    }
    $conn->close();