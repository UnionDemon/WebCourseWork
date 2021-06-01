<?php
    function error_page($error_msg, $back_link)
    {
        ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <TITLE>Ошибка</TITLE>
                    <meta charset="utf-8">
                    <link rel="stylesheet" type="text/css" href="/style2.css">
                </head>
                <body>
                <div id="main">
                    <p>
                        <?= $error_msg ?>
                    </p>
                    <p class="nav-item"><a href='<?= $back_link ?>'>Вернуться</a></p>
                </div>
                </body>

            </html>
        <?php
        die();
    }
