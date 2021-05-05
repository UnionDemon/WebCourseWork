<?php
    require_once("lib/db.php");
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
            <p class="nav-item"><a href="/validator.php">Тренажер/Валидатор HTML5</a></p>
            <p class="nav-item"><a href = "/articles.php">Каталог статей</a></p>
            <p class="nav-item"><a href = "/edit.php">Редактирование статей</a></p>
            <hr>
            <p class="nav-item"><a href="/login.php">Вход</a></p>
            <p class="nav-item"><a href="/autorization.php">Регистрация</a></p>
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