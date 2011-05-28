<?php
    session_start();

    include 'connect.php';
    include 'SQL.php';
    if(isset($_GET["mail"])){
        $result = view("users", "mail = '" . $_GET["mail"] . "'");
    }
    if(isset($_GET["user"])){
        $result = view("users", "username = '" . $_GET["user"] . "'");
        //$result = mysql_query("SELECT * FROM users WHERE username = '" . $_GET["user"] . "'");
    }

    $conta=mysql_num_rows($result);

    if(isset($_GET["mail"]) && $conta!=0){
        echo "O E-mail já existe!!!";
    }
    if(isset($_GET["user"]) && $conta!=0){
        echo "O Username já existe!!!";
    }

    mysql_close($con);
?>