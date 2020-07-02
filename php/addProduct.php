<?php
    include_once('../includes/dbConnect.php');
    $nameProd = $_POST['nameProd'];
    $pictureProd = $_POST['pictureProd'];
    $categoryProd = $_POST['categoryProd'];
    $priceProd = $_POST['priceProd'];
    $sizesProd = $_POST['sizesProd'];
    $fabricatorProd = $_POST['fabricatorProd'];
    $query = "INSERT INTO `products` (`name`, `picture`, `category`, `price`, `sizes`, `fabricator`) VALUES ('$nameProd', '$pictureProd', '$categoryProd', '$priceProd', '$sizesProd', '$fabricatorProd')";
    $result = $conn->query($query);
    if($result) echo true;
    else echo false;