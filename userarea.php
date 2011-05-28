<?php
session_start();


mysql_query("DELETE FROM users WHERE username='" . $_SESSION['user'] . "'");

mysql_close($con);
unset($_SESSION['user']);
session_destroy();
?>

<!DOCTYPE HTML>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        wikingon!
    </title>
    <link rel="stylesheet" type="text/css" href="stylecss.css">
</head>

<body>
    <?php include 'menus.php'; ?>

    <div class="txtarea">
        <div class="txtareaTy">
            <h1>
                Área de utilizador de <?php if (isset($_SESSION['user'])) echo $_SESSION['user']; ?>
            </h1>
        </div>
        <div class="txtareaTe">
            <?php
                include 'SQL.php';

                $result=view("users", "username='" . $_SESSION['user'] . "'");
                
                $row = mysql_fetch_array($result);
            ?>
            <table>
                <tr>
                <td>
                <form action="usermodificar.php" method="POST">
                    <table>
                        <tr>
                            <td>
                                <table>
                                    <tr>
                                        <td>Nome do Utilizador</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" style="background: transparent; border: 0px;" size="30" name="user" value="<?php echo $row['username']; ?>" readonly="readonly" /></td>
                                    </tr>
                                    <tr>
                                        <td>Nome</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" size="30" name="nome" value="<?php echo $row['nome']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" size="30" name="mail" value="<?php echo $row['mail']; ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td>Password</td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" size="30" name="pass" value="" /></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" size="50" value="Alterar" /></td>
                            <td><button onclick="apagar()">Apagar Conta</button></td>
                        </tr>
                    </table>
                </form>
                </td>
                <td>
                    <table>
                    <tr>
                        <td>
                            <p>Temas: </p>
                            <?php
                            $result = view("temas", "");
                            $i=1;
                            while($row = mysql_fetch_array($result)){
                            ?>
                            <input type="checkbox" id="<?php echo $i; ?>" name="<?php echo $i; ?>" value="<?php echo $row['tema']; ?>" onclick="func(<?php echo $i; ?>)" /><?php echo $row['tema'];?><br />
                            <?php
                                $i++;
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button onclick="escolher()">Marcar escolhas</button><br />

                            <input type="text" id="txtEscolhas" name="txtEscolhas" style="visibility: hidden">
                        </td>
                    </tr>
                </table>
                </tr>
            </table>

            <script type="text/javascript">
                function apagar(){
                    var e=confirm("Tem a certeza de que pretende eliminar esta conta?");
                    if (e==true){
                        window.close();
                        open('apagaruser.php');
                    }
                }

                function escolher(){
                    var esc = document.getElementById("txtEscolhas");
                    window.close();
                    open('escolher.php?escolha=' + esc.value);
                }

                function func(num) {
                    //style = "visibility: hidden"
                    var esc = document.getElementById("txtEscolhas");
                    if (esc.value == "")
                        esc.value = document.getElementById(num).value;
                    else
                        esc.value = esc.value + "," + document.getElementById(num).value;
                }
            </script>
        </div>
    </div>
</body>
</html>