<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HTML 5</title>
    <link rel="stylesheet" type="text/css" href="/style2.css">
    <script src="jquery-3.6.0.js"></script>
    <script>
        $(document).ready(
            function () {
                $("#testBtn").click(
                    function () {
                        var htmlCode=$("#code").val()
                        $("#testPage").attr("srcdoc", htmlCode)
                    }
                )
                $("#validBtn").click(
                    function () {
                        $("#alerts").empty()
                        var htmlCode=$("#code").val()
                        $.ajax(
                            "https://validator.w3.org/nu/?out=json",
                            {
                                contentType: "text/html; charset=utf-8",
                                data: htmlCode,
                                method: "POST",
                                success: function (data)
                                {
                                    var errors=data.messages
                                    if (errors.length === 0)
                                    {
                                        $("#alerts").append("Валидация пройдена успешно. Ошибок нет.")
                                    }
                                    var n = errors.length
                                    for (i=0; i<n; i++)
                                    {
                                        var msg = ""
                                        var error=errors[i]
                                        if (error.type==="error")
                                        {
                                            msg = msg+"Ошибка: "
                                        }
                                        else
                                        {
                                            msg = msg+"Предупреждение: "
                                        }
                                        msg = msg+error.message
                                        $("#alerts").append("<p>" + msg + "</p>")
                                        $("#alerts").append("<hr>")
                                    }
                                }
                            }
                        )
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
            <p class="nav-item"><a href="/validator.php">Тренажер/Валидатор HTML5</a></p>
            <p class="nav-item"><a href = "/articles.php">Каталог статей</a></p>
            <p class="nav-item"><a href = "/edit.php">Редактирование статей</a></p>
            <hr>
            <p class="nav-item"><a href="/login.php">Вход</a></p>
            <p class="nav-item"><a href="/autorization.php">Регистрация</a></p>
        </div>
        <div id="info">
            <form id="codeForm">
                <textarea id="code"></textarea><br>
                <input class="btn" id="testBtn" type="button" value="Показать">
                <input class="btn" id="validBtn" type="button" value="Проверить">
            </form>
            <iframe id="testPage" allowtransparency="true"></iframe>
            <div class="clear"></div>
            <div id="alerts"></div>
        </div>
        <div class="clear"></div>
    </div>
    <div id="author">© Егор Антонянц, 2021</div>
</body>
</html>