<?php
    session_start();

    include("connect.php");

    $result = mysql_query("SELECT * FROM users WHERE username <> '" . $_SESSION['user'] . "'");

    $flag1=2;
    $row = mysql_fetch_array($result);

    if(isset($_GET["mail"])){
        if(strtolower($row['mail'])==strtolower($_GET["mail"]))
            $flag1=0;
    }
    if(isset($_GET["user"])){
        if(strtolower($row['user'])==strtolower($_GET["user"]))
            $flag1=1;
    }

    $result = mysql_query("SELECT * FROM users WHERE username = '" . $_SESSION['user'] . "'");
    
    $row = mysql_fetch_array($result);

    if(isset($_GET["pass"])){
        if($row['password']==md5($_GET["pass"]))
            $flag1=1;
    }

    if($flag1==0){
        echo "O E-mail já existe!!!";
    }
    if($flag1==1){
        echo "O Username já existe!!!";
    }

    if(isset($_GET["pass"])){
        if($flag1==1){
            echo "certo";
        }
    }

    mysql_close($con);
?>