<?php
    require_once ("db.php");
    require_once ("error.php");
    require_once ("util.php");

    if(empty($_POST["login"]) || empty($_POST["passwd"]))
    {
        error_page("Не все поля заполнены.", "/login.php");
    }

    $query="SELECT * FROM users WHERE login='".$_POST["login"]."'";
    $statement = $_db->prepare($query);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if($result === false)
    {
        error_page("Такого пользователя не существует.", "/login.php");
    }

    $hashpasswd = md5($_POST["passwd"]);
    if($hashpasswd != $result["hpasswd"])
    {
        error_page("Неверный пароль.", "/login.php");
    }

    $token = generateToken();

    $query="UPDATE users SET token='" . $token . "' WHERE id='". $result["id"] . "'";
    $statement=$_db->prepare($query);
    $statement->execute();

    setcookie("token", $token, time() + 24 * 60 * 60, "/");
    setcookie("login", $_POST["login"], time() + 24 * 60 * 60, "/");

    header("Location: /index.php");