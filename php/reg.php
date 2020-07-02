<?php
    include_once("../includes/dbConnect.php");
    if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
        $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        $password = md5($password."qwerty");
        $firstName = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
        $lastName = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
        if($_POST['patronymic']) {
            $patronymic = filter_var(trim($_POST['patronymic']), FILTER_SANITIZE_STRING);
            $query = "INSERT INTO `users` (`login`, `password`, `firstname`, `lastname`, `patronymic`, `cart`) VALUES ('$login', '$password', '$firstName', '$lastName', '$patronymic', '')";
        }
        else {
            $query = "INSERT INTO `users` (`login`, `password`, `firstname`, `lastname`, `cart`) VALUES ('$login', '$password', '$firstName', '$lastName', '')";
        }
        if($result = $conn->query($query)) {
            echo true;
        }
        else echo false;
    }
    $conn->close();
?>