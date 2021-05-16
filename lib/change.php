<?php
    require_once ("db.php");

    $query="UPDATE articles SET title=?, content=? WHERE id=?";
    $statement=$_db->prepare($query);
    $statement->execute([$_POST["title"], $_POST["content"], $_POST["articleId"]]);

    $id = $_POST["articleId"];

    header("Location: /article.php?id=".$id);
