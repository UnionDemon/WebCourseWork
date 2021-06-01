<?php
    require_once("lib/db.php");
    require_once ("lib/util.php");

    $status=authStatus();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML 5 - Каталог статей</title>
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
            <h1>Каталог статей</h1>
            <?php
                $query = "SELECT * FROM articles";
                $statement = $_db->prepare($query);
                $statement->execute();
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($res as $row)
                {
                    ?>
                        <div class="article_card">
                            <h3><a href='/article.php?id=<?= $row["id"] ?>'><?= htmlentities($row["title"]) ?></a></h3>
                        </div>
                    <?php
                }

            ?>


        </div>
        <div class="clear"></div>
    </div>
    <div id="author">© Егор Антонянц, 2021</div>
</body>
</html>