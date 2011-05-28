<?php
    if(isset($_POST["user"])){

        include 'SQL.php';



        $vect[0]=$_POST["nome"];
        $vect[1]=$_POST["user"];
        $vect[2]=$_POST["mail"];
        $vect[3]=md5($_POST["pass"]);

        proc("registo", $vect);
        /*$from = "wikingon@gmail.com";
        $email = $_REQUEST["mail"];
        $subject = "Bem Vindo ao wikingon!";
        $message = "Obrigado por criar a sua conta no wikingon!. Brevemente estaremos no nosso potencial m�ximo e voc� vai poder fazer parte de n�s.";
        mail("$email", "Subject: $subject", $message, "From: $from");*/

        mysql_close($con);

        ?>
        <script type="text/javascript">
            alert("Parabéns o seu registo foi efectuado com sucesso.");
            setTimeout("location.href='index.php'", 0);
        </script>
        <?php
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
                Registar
            </h1>
        </div>
        <div class="txtareaTe">
            <form name="registo" action="registar.php" method="POST" onsubmit="return validar();">
                <table style="text-align: center;">
                    <tr>
                        <td>Nome</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nome" size="50"/></td>
                    </tr>
                    <tr>
                        <td>Username</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="user" size="50" onkeyup="verifica('user');"/>
                            <div id="user"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="mail" size="50" onkeyup="verifica('mail');"/>
                            <div id="mail"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                            <img src="images/info.png" alt="" onmouseover="info(1);" onmouseout="info(2);"/>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" name="pass" id="pass" size="50"/></td>
                    </tr>
                    <tr>
                        <td>Confirmar Password</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" name="pass2" size="50" onkeyup="compara();"/>
                            <div id="pass2"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Registar"/></td>
                    </tr>
                </table>
            </form>
        </div>
        <div id="info" style="position: relative; top: 25px;"></div>
    </div>

    <script type="text/javascript">
        jQuery('#pass').pstrength({'debug': true});
        jQuery('#pass').pstrength.addRule('twelvechar', function (word, score) {
                return word.length >= 12 && score;}, 3, true);
    </script>

    <script type="text/javascript">
        var verif="";
        function verifica(st){
            var xmlhttp;
            if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            }
            else{// code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function(){
                if (xmlhttp.readyState==4 && xmlhttp.status==200){
                    document.getElementById(st).innerHTML=xmlhttp.responseText;
                    verif=xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET","verificareg.php?"+st+"="+document.forms["registo"][st].value,true);
            xmlhttp.send();
        }

        function info(n){
            if(n==1)
                document.getElementById("info").innerHTML="<img src='images/info.png' alt=''/>Combine letras maiusculas, minusculas, caracteres especiais e números para obter uma password mais forte.";
            if(n==2)
                document.getElementById("info").innerHTML="";
        }

        function compara(){
            var pass=document.forms["registo"]["pass"].value;
            var pass2=document.forms["registo"]["pass2"].value;
            if(pass!=pass2)
                document.getElementById("pass2").innerHTML="As passwords são diferentes.";
            else
                document.getElementById("pass2").innerHTML="";
        }

        function validar(){
            var nome=document.forms["registo"]["nome"].value;
            var user=document.forms["registo"]["user"].value;
            var mail=document.forms["registo"]["mail"].value;
            var pass=document.forms["registo"]["pass"].value;
            var pass2=document.forms["registo"]["pass2"].value;
            if(verif!=""){
                alert("Ainda existem erros no formulário!");
                return false;
            }
            if(pass.length<6){
                alert("A password deve ter pelo menos 6 caracteres!");
                return false;
            }
            if(nome==null || nome=="" || user==null || user=="" ||
                mail==null || mail=="" || pass==null || pass=="" ||
                pass2==null || pass2==""){
                alert("Todos os campos tâm de ser preenchidos!");
                return false;
            }
            if(pass!=pass2){
                alert("Passwords diferentes!");
                return false;
            }
            var mail=document.forms["registo"]["mail"].value
            var atpos=mail.indexOf("@");
            var dotpos=mail.lastIndexOf(".");
            if(atpos<1 || dotpos<atpos+2 || dotpos+2>=mail.length){
                alert("E-mail inválido!");
                return false;
            }
        }
    </script>
</body>
</html>