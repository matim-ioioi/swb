<?php
    include_once('../includes/dbConnect.php');
    echo "<table cellpadding=\"5px\" class=\"table table-sm table-hover table-bordered\">";
    echo "<tr><th scope=\"col\">id</th><th scope=\"col\">login</th><th scope=\"col\">password</th><th scope=\"col\">firstname</th><th scope=\"col\">lastname</th><th scope=\"col\">patronymic</th><th scope=\"col\">picture</th><th scope=\"col\">status</th><th scope=\"col\">cart</th></tr>";
    $sql = "SELECT * FROM `users`";
    $result = $conn->query($sql);
    $totalRows = $result->num_rows;
    if($totalRows < 1) {
        echo "<tr><td> No Data: DataBase Empty </td>";
        echo "<td> No Data: DataBase Empty </td>";
        echo "<td> No Data: DataBase Empty </td>";
        echo "<td> No Data: DataBase Empty </td>";
        echo "<td> No Data: DataBase Empty </td></tr>";
    }
    else {
        while($row = $result->fetch_assoc()) {
            echo "<tr id='row{$row['id']}'>";
            echo "<td>{$row['id']}</td><td>{$row['login']}</td><td>{$row['password']}</td><td>{$row['firstname']}</td><td>{$row['lastname']}</td><td>{$row['patronymic']}</td><td>{$row['picture']}</td><td>{$row['status']}</td><td>{$row['cart']}</td>";
            echo "<td><div class=\"btn-group btn-group-sm\" role=\"group\"><button type=\"button\" class=\"btn btn-outline-secondary\" onclick=\"editUser({$row['id']})\" id=\"editUserBtn\">Edit</button>";
            echo "<button type=\"button\" class=\"btn btn-outline-secondary\" id=\"deleteUsersBtn\" onclick=\"removeUser({$row['id']})\">Delete</button></div></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
?>