<?php
    setcookie("login", null, -1, "/");
    setcookie("token", null, -1, "/");

    header("Location: /index.php");