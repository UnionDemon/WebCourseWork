<?php
    require_once ("lib/util.php");
    require_once ("lib/error.php");
    require_once ("lib/db.php");

    $status=authStatus();
    if ($status["isAdmin"] === false)
    {
        error_page("У Вас нет доступа к этой странице", "/index.php");
    }

    $action="/lib/publish.php";
    $title="";
    $content="";
    $submit="Создать";

    if(isset($_GET["id"]))
    {
        $action="/lib/change.php";

        $query="SELECT * FROM articles WHERE id=?";
        $statement=$_db->prepare($query);
        $statement->execute([$_GET["id"]]);
        $result=$statement->fetch(PDO::FETCH_ASSOC);

        if($result === false)
        {
            error_page("Такой статьи не существует", "/articles.php");
        }

        $title=$result["title"];
        $content=$result["content"];
        $submit="Редактировать";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML 5 - Создание/Редактирование статьи</title>
    <link rel="stylesheet" type="text/css" href="/style2.css">
</head>
<body>
    <div id="main">
        <div id="navigation">
            <p class="nav-item"><a href="/index.php">Главная</a></p>

            <?php
            if ($status["authorized"] === true)
            {
                ?>
                <p class="nav-item"><a href="/validator.php">Тренажер/Валидатор HTML5</a></p>
                <?php
            }
            ?>
            <p class="nav-item"><a href = "/articles.php">Каталог статей</a></p>

            <?php
            if ($status["isAdmin"] === true)
            {
                ?>
                <p class="nav-item"><a href = "/gallery.php">Галерея</a></p>
                <p class="nav-item"><a href = "/edit.php">Создать статью</a></p>
                <?php
            }
            ?>
            <hr>
            <?php
            if($status["authorized"])
            {
                ?>
                <p class="nav-item inactive">Привет, <?= $status["login"] ?> </p>
                <p class="nav-item"><a href = "/logout.php">Выйти</a></p>
                <?
            } else {
                ?>
                <p class="nav-item"><a href="/login.php">Вход</a></p>
                <p class="nav-item"><a href="/reg.php">Регистрация</a></p>
                <?php
            }
            ?>

        </div>
        <div id="info">
            <form class="codeForm" action='<?= $action ?>' method="post">
                <input class="lp title" name="title" type="text" value='<?= $title ?>'>
                <textarea id="code" name="content"><?= htmlentities($content) ?></textarea><br>
                <input class="btn" id="createBtn" type="submit" value='<?= $submit ?>'>
                <input type="hidden" name="articleId" value='<?= $_GET["id"]?>'>
            </form>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="author">© Егор Антонянц, 2021</div>
</body>
</html>