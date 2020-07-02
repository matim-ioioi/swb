<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>About Swb</title>
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
        <p class="p-5 text-dark" style="font-size: xx-large">&nbsp;&nbsp;&nbsp;&nbsp;Swb it's a modern online store that let you to buy wear without leaving home. Our company aims to create fast loading online store which in addition will have cool effects and loading animations!</p>
        <hr class="my-5">
        <p class="pl-5 pt-3 pb-0 text-dark" style="font-size: x-large">&nbsp;&nbsp;&nbsp;&nbsp;<a href="catalog.php">There are</a> you can pick and add to cart some wear if you like this. P.S. before it you must to sign up!</p>
        <p class="pl-5 py-0 text-dark" style="font-size: x-large">&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://instagram.com/">This</a> is our account in "Instargam". Subscribe to not miss important events and promotions! You can also subscribe to our group in "VK"! Click <a href="http://vk.com/">here</a> to do it! You can always see these links in the lower right corner of the page, just scroll to the very bottom!</p>
        <hr class="my-5">
        <p class="px-5 pt-5 py-0 text-dark" style="font-size: xx-large">&nbsp;&nbsp;&nbsp;&nbsp;Well, now you know everything and are ready to make purchases on our website! We wish you good luck and good shopping!</p>
    </div>

    <?php
        include_once("includes/footer.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script src="js/main.js"></script>

</body>

</html>