<?php
    require_once ("lib/db.php");

    $query="DELETE FROM articles WHERE id=?";
    $statement=$_db->prepare($query);
    $statement->execute([$_GET["id"]]);

    header("Location: /articles.php");