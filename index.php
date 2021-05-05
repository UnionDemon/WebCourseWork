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
            <h1>Последние публикации:</h1>

            <?php
                $query = "SELECT * FROM articles";
                $statement = $_db->prepare($query);
                $statement->execute();
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);

                foreach ($res as $row)
                {
                    ?>
                        <div class="article_card">
                            <h3><?= $row["title"] ?></h3>
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