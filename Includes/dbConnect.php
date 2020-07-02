<?php
    $conn = mysqli_connect("localhost", "root", "")
    or die("Нет соединения: ".mysqli_error($conn));
    $dbName = "swol";
    mysqli_select_db($conn, $dbName)
    or die("Не выбрана база данных: ".mysqli_error($conn));