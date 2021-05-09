<?php
    require_once("lib/db.php");
    require_once ("lib/util.php");

    $status=authStatus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML 5</title>
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
            <?php
                $a_id = $_GET["id"];

                $query = "SELECT * FROM articles WHERE id=" . $a_id;
                $statement = $_db->prepare($query);
                $statement->execute();
                $res = $statement->fetch(PDO::FETCH_ASSOC);

                if ($res === false)
                {
                    ?>
                        <p>Такой статьи не существует</p>
                    <?php
                }
                else
                {
                    ?>
                        <h1><?= $res["title"] ?></h1>
                        <?= $res["content"] ?>
                    <?php
                }

            ?>


        </div>
        <div class="clear"></div>
    </div>
    <div id="author">© Егор Антонянц, 2021</div>
</body>
</html>