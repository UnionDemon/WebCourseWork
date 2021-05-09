<?php
    require_once ("db.php");

    function generateToken()
    {
        $token="";
        for ($i=1; $i<=32; $i++)
        {
            $code=rand(ord("a"),ord("z"));
            $c = chr($code);
            $token = $token . $c;
        }
        return $token;
    }

    function authStatus()
    {
        global $_db;

        $result = array("authorized" => false, "isAdmin" => false, "login" => null);

        if(!isset($_COOKIE["login"]) || !isset($_COOKIE["token"]))
        {
            return $result;
        }

        $query="SELECT token, isAdmin FROM users WHERE login='".$_COOKIE["login"]."'";
        $statement = $_db->prepare($query);
        $statement->execute();

        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row["token"] != $_COOKIE["token"])
        {
            return $result;
        }

        $result["authorized"]=true;
        $result["login"]=$_COOKIE["login"];

        if ($row["isAdmin"] == true)
        {
            $result["isAdmin"]=true;
        }
        return $result;
    }