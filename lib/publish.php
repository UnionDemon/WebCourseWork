<?php
    require_once ("db.php");
    require_once ("error.php");

    if(empty($_POST["content"]) || empty($_POST["title"]))
    {
        error_page("Не все поля заполнены.", "/edit.php");
    }

    //$content = $_db->quote($_POST["content"]);
    $content = $_POST["content"];

    $query="INSERT INTO articles(title, content, publish_date) VALUES ('".$_POST["title"]."', '".$content."', NOW())";
    $statement = $_db->prepare($query);
    $statement->execute();

    header("Location: /articles.php");