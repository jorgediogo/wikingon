<?php
session_start();

if(isset($_POST["user"])){
    include 'SQL.php';

    $result=view("users", "username='" . $_POST["user"] . "'");

    if(mysql_num_rows($result)==0){
        ?>
        <script type="text/javascript">
            alert("Este username não se encontra na base de dados!");
            setTimeout("location.href='index.php'", 0);
        </script>
        <?php
    }
    else{
        $row = mysql_fetch_array($result);
        if($row['password']==md5($_POST["pass"])){
            $_SESSION['user']=$_POST["user"];
            ?>
            <script type="text/javascript">
                setTimeout("location.href='userarea.php'", 0);
            </script>
            <?php
        }
        else{
            ?>
            <script type="text/javascript">
                alert("A password está errada!");
                setTimeout("location.href='index.php'", 0);
            </script>
            <?php
        }
    }
}

if(isset($_POST["logout"])){
    unset($_SESSION['user']);
    session_destroy();
    ?>
    <script type="text/javascript">
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
                Bem-vindo à <fonteHandTest style="font-size: 50px;">wikingon<colorHTblue>!</colorHTblue></fonteHandTest>
            </h1>
        </div>
        <div class="txtareaTe">
            <table>
                <tr>
                    <td>
                        <p>
                            O projecto wikingon serve para mostrar ao mundo que as <i>Wikis</i> podem,
                                na verdade, ser uma fonte fiável de informação.
                        </p>
                        <p>
                            Toda a gente pode editar ou criar informação sobre qualquer área, mas esta
                                informação é revista de forma a manter toda a fiabilidade dos dados.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                            include 'SQL.php';

                            $result = view("cinco" , "");

                            $i=0;
                        ?>
                        <p>Últimos artigos
                            <ul>
                        <?php
                            while($row = mysql_fetch_array($result)){
                                if($i<5){
                                ?>
                                <li><a href="artigo.php?titulo=<?php echo $row['titulo']; ?>"><?php echo $row['titulo']; ?></a>
                                    , criado por: <a href="utilizador.php?autor=<?php echo $row['autor']; ?>"><?php echo $row['autor']; ?></a>
                                    , tema: <a href="tema.php?tema=<?php echo $row['tema']; ?>"><?php echo $row['tema']; ?></a></li>
                                <?php
                                }
                                $i++;
                            }
                            ?>
                            </ul>
                        </p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
