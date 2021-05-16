<?php
    require_once("lib/util.php");
    require_once("lib/error.php");

    $status = authStatus();

    if (!$status["isAdmin"])
    {
        error_page("У вас нет прав на загрузку файла", "/index.php");
    }

    $dir = "gallery/";
    $file_destination = $dir . basename($_FILES['uploadable']['name']);

    if (move_uploaded_file($_FILES['uploadable']['tmp_name'], $file_destination))
    {
        header("Location: /gallery.php");
        die();
    }
    else
    {
        error_page("Возникла ошибка при загрузке файла", "/gallery.php");
    }

