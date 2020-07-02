<header id="header">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">

        <a class="navbar-brand" href="../index.php">Swb</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <?php
                    foreach(glob("*.php") as $filename) {
                        if($filename != "index.php" && $filename != "profile.php") {
                            echo "<li id=\"" . explode(".php", $filename)[0] . "\" class=\"nav-item\">
                                    <a class=\"nav-link font-weight-bold\" href=\"../" . $filename . "\">" . ucfirst(explode(".php", $filename)[0]) . "</a>
                                  </li>";
                        }
                    }
                ?>
                <li id="search" class="nav-item">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-light mr-sm-5" type="submit">Search</button>
                    </form>
                </li>
            </ul>
        </div>

        <?php
            if(!$_COOKIE['login']) echo "
            <button class=\"btn btn-secondary font-weight-bold\" id=\"signInBtn\" data-toggle=\"modal\" data-target=\"#signInModal\" data-whatever=\"@signIn\">Sign in</button>

            <div class=\"modal fade\" id=\"signInModal\" tabindex=\"-1\" role=\"dialog\" data-backdrop=\"static\" data-keyboard=\"false\" aria-labelledby=\"signInModalLabel\" aria-hidden=\"true\">
                <div class=\"modal-dialog\" role=\"document\">
                    <div class=\"modal-content\">
                        <div class=\"modal-header\">
                            <h5 class=\"modal-title\" id=\"signInModalLabel\" style=\"font-size: 25px;\">Sign in</h5>
                        </div>
                        <div class=\"modal-body\">
                            <form method=\"post\" action=\"php/auth.php\" id=\"signUpForm\">
                                <div class=\"form-group item\" id=\"divLogin\">
                                    <label for=\"login\" class=\"col-form-label\">Login:</label>
                                    <input type=\"text\" class=\"form-control\" id=\"login\" name=\"login\" required placeholder=\"Input your login here\">
                                </div>
                                <div class=\"form-group\" id=\"divPassword\">
                                    <label for=\"password\" class=\"col-form-label\">Password:</label>
                                    <input type=\"password\" class=\"form-control\" id=\"password\" name=\"password\" required placeholder=\"Input your password here\">
                                </div>
                                <div class=\"modal-footer justify-content-between\" id=\"divButtons\">
                                    <button type=\"button\" class=\"text-primary border-0 bg-transparent\" id=\"labelRegLog\" onclick=\"toReg()\">Haven't an account?</button>
                                    <input type=\"submit\" form=\"signUpForm\" class=\"btn btn-dark w-25\" id=\"signInUpBtn\" value=\"Sign in\">
                                    <button type=\"button\" class=\"btn btn-danger w-25\" data-dismiss=\"modal\" onclick=\"clearInputs()\">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            ";
            else {
                echo "
                    <ul class=\"navbar-nav ml-auto\">
                        <li class=\"nav-item\" id=\"profile\">
                            <a class=\"btn btn-secondary nav-link font-weight-bold\" href=\"../profile.php\">Profile<span class=\"badge badge-light ml-1 mr-1 mt-0 mb-0\" id=\"countCart\"></span></a>
                        </li>
                    </ul>
                ";
            }
        ?>

    </nav>
</header>