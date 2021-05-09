<?php
    require_once ("db.php");
    require_once ("error.php");

    if(empty($_POST["login"]) || empty($_POST["passwd"]))
    {
        error_page("Не все поля заполнены.", "/reg.php");
    }

    $query="SELECT COUNT(*) AS count FROM users WHERE users.login='" . $_POST["login"] . "'";
    $statement = $_db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result["count"] == 1)
    {
        error_page("Пользователь с таким логином уже существует.", "/reg.php");
    }

    $reg_query="INSERT INTO users(login, hpasswd, isAdmin) VALUES ('".$_POST["login"]."', md5('".$_POST["passwd"]."'), 0)";
    $statement = $_db->prepare($reg_query);
    $statement->execute();

