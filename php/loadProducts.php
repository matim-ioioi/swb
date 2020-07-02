<?php
    include_once('../includes/dbConnect.php');
    $query = "SELECT products.id `p.id`, products.name `p.name`, categories.name `c.name`, products.picture `p.picture`, products.price `p.price`, products.sizes `p.sizes`, fabricators.name `f.name` FROM `categories` INNER JOIN `products` ON categories.id = products.category INNER JOIN `fabricators` ON products.fabricator = fabricators.id ORDER BY {$_POST['sortBy']} LIMIT 4 OFFSET {$_POST['offsetProducts']}";
    $result = $conn->query($query);
    $totalRows = $result->num_rows;
    if($totalRows < 1) {
        echo false;
    }
    else {
        while($product = $result->fetch_assoc()) {
            echo "<div class=\"card m-3 mr-5 border-dark\" id=\"{$product['p.id']}\" style=\"width: 20rem;\">";
            echo "<img src=\"../pictures/products/{$product['p.picture']}\" class=\"card-img-top\" id=\"picture{$product['p.id']}\" style=\"height: 250px;\" alt=\"img\">";
            echo "<div class=\"card-body\">";
            echo "<hr style=\"margin-bottom: .7rem;\"><h5 class=\"card-title\" style=\"font-size: 20px\">{$product['p.name']}</h5><hr style=\"margin-bottom: .3rem;\">";
            echo "<p class=\"card-text\" id=\"category{$product['p.id']}\">Category: {$product['c.name']}</p>";
            echo "<p class=\"card-text\" id=\"price{$product['p.id']}\">Price: {$product['p.price']} RUB</p>";
            echo "<p class=\"card-text\" id=\"sizes{$product['p.id']}\">Sizes: {$product['p.sizes']}.</p>";
            echo "<p class=\"card-text\">Fabricator: {$product['f.name']}</p></div>";

            if($_COOKIE['status'] === 'administrator') {
                echo "<div class=\"card-footer d-flex justify-content-between\" id=\"cardFooter{$product['p.id']}\">";
                echo "<button class=\"btn btn-sm btn-outline-secondary w-50\" onclick=\"addToCart({$product['p.id']})\">Add to cart</button>";
                echo "<button class=\"btn btn-sm btn-outline-secondary w-50\" onclick=\"editProduct({$product['p.id']});\">Edit</button>";
                echo "<button class=\"btn btn-sm btn-outline-secondary w-50\" onclick=\"removeProduct({$product['p.id']});\">Remove</button></div></div>";
            }
            else {
                echo "<div class=\"card-footer d-flex justify-content-center\" id=\"cardFooter{$product['p.id']}\">";
                echo "<button class=\"btn btn-sm btn-outline-secondary w-50\" onclick=\"addToCart({$product['p.id']})\">Add to cart</button></div></div>";
            }
        }
    }
?>
