<?php
    function error_page($error_msg, $back_link)
    {
        ?>
            <!DOCTYPE html>
            <html>
                <head>
                    <TITLE>Ошибка</TITLE>
                    <meta charset="utf-8">
                </head>
                <body>
                    <p>
                        <?= $error_msg ?>
                    </p>
                    <a href='<?= $back_link ?>'>Вернуться</a>
                </body>

            </html>
        <?php
        die();
    }
