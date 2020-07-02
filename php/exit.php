<?php
    setcookie('login', '', time()-3600,"/");
    setcookie('firstname', '', time()-3600,"/");
    setcookie('lastname', '', time()-3600,"/");
    if($_COOKIE['patronymic']) setcookie('patronymic', '', time()-3600,"/");
    setcookie('status', '', time()-3600,"/");
    echo true;