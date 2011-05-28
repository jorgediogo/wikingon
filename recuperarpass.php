<?php
    if(isset($_POST["user"])){
        include 'SQL.php';

        $result=view("users", "username='" . $_POST["user"] . "'");

        while($row = mysql_fetch_array($result)){
            /*$email = $row["email"] ;
            $subject = "Recuperação de Password";
            $message = "A sua password é: " . $row["password"];
            $from = "wikingon@gmail.com";
            mail($email, "Subject: $subject", $message, "From: $from");*/
            ?>
            <script type="text/javascript">
                alert("Irá receber um e-mail com a password.");
                setTimeout("location.href='index.php'", 0);
            </script>
            <?php
        }

        if(mysql_num_rows($result)==0){
            ?>
            <script type="text/javascript">
                alert("Este username não se encontra na base de dados!");
                setTimeout("location.href='recuperarpass.php'", 0);
            </script>
            <?php
        }
    }
?>

<!DOCTYPE HTML>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        wikingon!
    </title>
</head>

<body>
    <?php include 'menus.php'; ?>

    <div class="txtarea">
        <div class="txtareaTy">
            <h1>
                Recuperar password
            </h1>
        </div>
        <div class="txtareaTe">
            <p>
                A password será enviada para o e-mail que tem referido na sua conta
            </p>
            <form name="recup" action="recuperarpass.php" method="POST" onsubmit="return validar();">
                <table>
                    <tr>
                        <td>Nome do Utilizador</td>
                    </tr>
                    <tr>
                        <td><input type="text" size="30" name="user" /></td>
                    </tr>
                    <tr>
                        <td><input type="submit" size="50" value="Enviar password" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script type="text/javascript">
        function validar(){
            var user=document.forms["recup"]["user"].value;
            if(user==null || user==""){
                alert("Todos os campos têm de ser preenchidos!");
                return false;
            }
        }
    </script>
</body>
</html>