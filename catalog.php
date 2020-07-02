<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shopping via Swb</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-grid.css">
    <link rel="stylesheet" href="css/bootstrap-reboot.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@600&family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
</head>

<body>

    <?php
        include_once("includes/dbConnect.php");
        include_once("includes/header.php");
    ?>

    <div class="container-fluid" id="mainContainer">
        <div id="layer"></div>
        <div class="row p-3" id="sortProducts">
            <div class="col-3">
                <form action="" id="sortForm"></form>
                <div class="sort-dd dropdown">
                    <button class="btn btn-sm btn-outline-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sorted by: Recommended</button>
                    <div class="dropdown-menu border-dark">
                        <div class="dropdown-item">
                            <label>Recommended</label>
                            <input type="radio" form="sortForm" name="sortBy" id="sortRecommended" value="`p.id`" hidden>
                        </div>
                        <hr>
                        <div class="dropdown-item">
                            <label>Low price</label>
                            <input type="radio" form="sortForm" name="sortBy" id="sortLowPrice" value="`price` asc" hidden>
                        </div>
                        <hr>
                        <div class="dropdown-item">
                            <label>High price</label>
                            <input type="radio" form="sortForm" name="sortBy" id="sortHighPrice" value="`price` desc" hidden>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">

            </div>
            <div class="col-3">

            </div>
            <div class="col-3">

            </div>
        </div>
        <div class="row pt-3" id="productsList">
            <div class="col d-flex flex-wrap" id="productsContent">

            </div>
        </div>
        <div class="row m-3" id="loadMore">
            <div class="col">
                <div class="text-center after-products">
                    <button type="button" class="btn btn-lg btn-outline-dark" id="loadProductsBtn">Load more</button>
                </div>
            </div>
        </div>
    </div>

    <?php
        include_once("includes/footer.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="js/main.js"></script>

</body>

</html>