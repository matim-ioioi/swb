<?php
    include_once('../includes/dbConnect.php');
    echo "<table cellpadding=\"5px\" class=\"table table-sm table-hover table-bordered\">";
    echo "<tr><th>id</th><th>name</th><th>boss</th></tr>";
    $sql = "SELECT * FROM `fabricators`";
    $result = $conn->query($sql);
    $totalRows = $result->num_rows;
    if($totalRows < 1) {
        echo "<tr><td> No Data: DataBase Empty </td>";
        echo "<td> No Data: DataBase Empty </td>";
        echo "<td> No Data: DataBase Empty </td></tr>";
    }
    else {
        while($row = $result->fetch_assoc()) {
            echo "<tr id='row{$row['id']}'>";
            echo "<td>{$row['id']}</td><td>{$row['name']}</td><td>{$row['boss']}</td>";
            echo "<td><div class=\"btn-group btn-group-sm\" role=\"group\"><button type=\"button\" class=\"btn btn-outline-secondary\" onclick=\"editFabricator({$row['id']})\" id=\"editUserBtn\">Edit</button>";
            echo "<button type=\"button\" class=\"btn btn-outline-secondary\" id=\"deleteFabricatorsBtn\" onclick=\"removeFabricator({$row['id']})\">Delete</button></div></td>";
            echo "</tr>";
        }
    }
    echo "</table>";
?>