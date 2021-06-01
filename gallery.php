<?php
    require_once("lib/db.php");
    require_once ("lib/util.php");
    require_once ("lib/error.php");

    $status=authStatus();
    if($status["isAdmin"] == false)
    {
        error_page("Доступ к данной странице запрещен.", "/index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML 5 - Галерея</title>
    <link rel="stylesheet" type="text/css" href="/style2.css">
    <script src="jquery-3.6.0.js"></script>
    <script>
        $(document).ready(
            function ()
            {
                $(".linkBtn").click(
                    function () {
                        var link = $(this).attr("src")
                        $("#nested_img").attr("src", link)
                        $("#nested_img").show()
                    }
                )
            }
        )
    </script>
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
            <h1>Загрузить файл</h1>
            <form action="/upload.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="uploadable"><br>
                <input type="submit" value="Загрузить" class="btn">
            </form>

            <h1>Загруженные на сайт файлы</h1>

            <div id="gallery_container">
                <div class="fileList">
                    <ul id="fileUl">
                        <?php
                        $files=scandir("gallery");
                        foreach ($files as $file)
                        {
                            if ($file === "." || $file === "..")
                            {
                                continue;
                            }
                            echo "<li><span class='linkBtn' src='/gallery/".$file."'>".$file."</span></li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="show"><img id="nested_img" src="/gallery/head.jpg" hidden></div>
            </div>



        </div>
        <div class="clear"></div>
    </div>
    <div id="author">© Егор Антонянц, 2021</div>
</body>
</html>