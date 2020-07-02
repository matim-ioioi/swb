<?php
    include_once('../includes/dbConnect.php');
    $query = "SELECT `cart` FROM `users` WHERE `login` = '{$_COOKIE['login']}'";
    $result = $conn->query($query);
    $arr = array();
    $cartStr = mysqli_fetch_assoc($result)['cart'];
    $arr = explode(' ', trim($cartStr));
    echo "<ul class=\"list-unstyled\">";
    echo "<i class=\"fa fa-2x fa-shopping-basket m-0\" aria-hidden=\"true\"></i>";
    foreach($arr as $elem) {
        $queryJoin = "SELECT products.id `p.id`, products.name `p.name`, categories.name `c.name`, products.picture `p.picture`, products.price `p.price`, products.sizes `p.sizes`, fabricators.name `f.name` FROM `categories` INNER JOIN `products` ON categories.id = products.category INNER JOIN `fabricators` ON products.fabricator = fabricators.id WHERE products.id = '{$elem}'";
        $resultJoin = $conn->query($queryJoin);
        $product = $resultJoin->fetch_assoc();
        echo "<li class='media my-4 border-bottom border-top border-dark p-3' id='wish{$product['p.id']}'>";
        echo "<img width='128' height='128' src='../pictures/products/{$product['p.picture']}' class='mr-3'>";
        echo "<div class='media-body'>";
        echo "<h5 class='mt-0 mb-1'>{$product['f.name']} {$product['p.name']} {$product['c.name']}</h5>";
        echo "<p class='wish-price'>Price: {$product['p.price']} RUB</p>";
        echo "<button class='btn btn-sm btn-outline-dark' onclick='deleteFromCart({$product['p.id']})'>delete</button></div></li>";
    }
    echo "</ul>";