<?php

    $_user = "user";
    $_pass = "1234";
    $_conn_string = "mysql:host=localhost;dbname=webprog";

    $_db = null;

    try {
        $_db = new PDO($_conn_string, $_user, $_pass);
    }
    catch (PDOException $ex)
    {
        error_page("Не удалось подключиться к базе данных: " . $ex->getMessage(), "/index.php");
    }
