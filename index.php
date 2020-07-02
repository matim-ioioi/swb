<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Swb</title>
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
        <div class="row align-items-start" style="height: 30vh">
            <div class="col text-center">
                <p class="text-dark p-5" style="font-size: x-large">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam neque enim, cursus sed risus at, malesuada tempor tellus. In hac habitasse platea dictumst. Nam cursus pretium mollis. Aliquam pretium in sapien sit amet accumsan. Proin non commodo leo. Maecenas dolor dolor, volutpat quis libero sed, ultrices commodo orci. Nam vel dictum eros. Suspendisse tellus ante, pulvinar bibendum nisi id, venenatis consectetur justo. Aliquam ac aliquam enim. Curabitur ultrices sapien eu ligula rhoncus, a ultricies nulla mattis. Ut ac odio enim.</p>
            </div>
        </div>
        <div class="row align-items-center" style="height: 20vh">
            <div class="col">
                <div id="carousel-container" class="container">
                    <div id="carouselControls" class="carousel slide carousel-fade" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="pictures/carousel/carousel1.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="pictures/carousel/carousel2.png" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="pictures/carousel/carousel3.png" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" style="opacity: 1" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-end" style="height: 30vh">
            <div class="col text-center">
                <p class="text-dark p-5" style="font-size: x-large">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam neque enim, cursus sed risus at, malesuada tempor tellus. In hac habitasse platea dictumst. Nam cursus pretium mollis. Aliquam pretium in sapien sit amet accumsan. Proin non commodo leo. Maecenas dolor dolor, volutpat quis libero sed, ultrices commodo orci. Nam vel dictum eros. Suspendisse tellus ante, pulvinar bibendum nisi id, venenatis consectetur justo. Aliquam ac aliquam enim. Curabitur ultrices sapien eu ligula rhoncus, a ultricies nulla mattis. Ut ac odio enim.</p>
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