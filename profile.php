<?php
    if(!isset($_COOKIE['login'])) header('location:index.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo ucfirst($_COOKIE['login'])."'s profile" ?></title>
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
        <div class="row">
            <div class="col-4">
                <div class="card mt-3 mb-5 bg-light w-75">
                    <button type="button" class="btn" data-toggle="modal" data-target="#loadPic">
                        <img class="card-img-top" id="userPicture" alt="Click to upload your photo" width="300" height="200"
                             src="<?php
                             $result = $conn->query("SELECT `picture` FROM `users` WHERE `login` = '{$_COOKIE['login']}'");
                             if($namePic = $result->fetch_row()) if($namePic[0]) echo "pictures/avatars/".$namePic[0];
                             else echo "pictures/avatars/default.png";
                             ?>">
                    </button>
                    <div class="card-body">
                        <p class="card-text" id="loginText">
                            <?php
                                echo "Login: ".$_COOKIE['login'];
                            ?>
                        </p>
                        <p class="card-text" id="firstNameText">
                            <?php
                                echo "First name: ".ucfirst($_COOKIE['firstname']);
                            ?>
                        </p>
                        <p class="card-text" id="lastNameText">
                            <?php
                                echo "Last name: ".ucfirst($_COOKIE['lastname']);
                            ?>
                        </p>
                        <?php
                            if(!empty($_COOKIE['patronymic'])) {
                                echo "<p class=\"card-text\" id=\"patronymicText\">Patronymic: ".ucfirst($_COOKIE['patronymic'])."</p>";
                            }
                        ?>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#loadPic">Change photo</button>
                        <button class="btn btn-sm btn-danger" onclick="signOut()">Exit</button>
                    </div>
                </div>

            </div>
            <div class="col-4">

                <div class="container-fluid mt-3 mb-3">
                    <?php
                        if($_COOKIE['status'] == 'administrator') {
                            echo '<button class="btn btn-secondary font-weight-bold" id="usersEditBtn" data-toggle="modal" data-target="#usersEditModal">Edit users</button>';
                            echo '<button class="btn btn-secondary font-weight-bold" id="fabricatorsEditBtn" data-toggle="modal" data-target="#fabricatorsEditModal">Edit fabricators</button>';
                            echo '<button class="btn btn-secondary font-weight-bold" id="addProductBtn" data-toggle="modal" data-target="#addProductModal">Add a product</button>';
                        }
                    ?>
                </div>

            </div>
            <div class="col-4">

                <div class="container-fluid">
                    <div class="overflow-auto mt-3 mb-3 p-3 border border-dark" id="divCart" style="visibility: hidden">
                        <button class="btn btn-sm btn-outline-dark w-50" id="makeAnOrderBtn" onclick="makeAnOrder()">Buy</button>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductModalTitle" style="font-size: 25px;">Add a new product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body align-self-center" id="addProductDiv">
                        <form action="">
                            <div class="form-group item" id="divNameProd">
                                <label for="nameProd" class="col-form-label">Product's name:</label>
                                <input type="text" class="form-control" id="nameProd" placeholder="Product's name">
                            </div>
                            <div class="form-group" id="divPictureProd">
                                <label for="pictureProd" class="col-form-label">Product's picture:</label>
                                <input type="text" class="form-control" id="pictureProd" placeholder="Picture's directory">
                            </div>
                            <div class="form-group" id="divCategoryProd">
                                <label for="categoryProd" class="col-form-label">Product's category:</label>
                                <select name="category" class="form-control" id="categoryProd"><?php include_once('php/loadCategories.php') ?></select>
                            </div>
                            <div class="form-group" id="divPriceProd">
                                <label for="priceProd" class="col-form-label">Product's price:</label>
                                <input type="text" class="form-control" id="priceProd" placeholder="Product's price">
                            </div>
                            <div class="form-group" id="divSizesProd">
                                <label for="sizesProd" class="col-form-label">Product's sizes:</label>
                                <input type="text" class="form-control" id="sizesProd" placeholder="Product's sizes">
                            </div>
                            <div class="form-group" id="divFabricatorProd">
                                <label for="fabricatorProd" class="col-form-label">Product's fabricator:</label>
                                <select name="fabricator" class="form-control" id="fabricatorProd"><?php include_once('php/loadFabricators.php') ?></select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-dark" id="addProductBtn" onclick="addProduct()">Add</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="fabricatorsEditModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="fabricatorsEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fabricatorsEditModalTitle" style="font-size: 25px;">Fabricators table</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body align-self-center" id="fabricatorsTableDiv">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="usersEditModal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="usersEditModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="usersEditModalTitle" style="font-size: 25px;">Users table</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body align-self-center" id="usersTableDiv">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-sm fade" id="loadPic" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title" id="loadPicTitle">Upload your profile's photo</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="php/loadPicture.php" id="formPic">
                            <input type="file" name="inputPic" id="inputPic" accept=".jpg, .png">
                        </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <input type="submit" form="formPic" value="Save photo" class="btn btn-sm btn-outline-secondary" id="submitPic">
                        <i class="fa fa-spinner fa-pulse fa-lg fa-fw" id="loadIcon" style="display: none"></i>
                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
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