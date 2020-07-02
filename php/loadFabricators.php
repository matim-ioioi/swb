<?php
    $query = "SELECT * FROM `fabricators`";
    $result = $conn->query($query);
    while($row = $result->fetch_assoc()) {
        echo "<option value='{$row['id']}'>{$row['name']}</option>";
    }