
<link rel="stylesheet" type="text/css" href="styles.css">
<script type="text/javascript" src="jquery/jquery.js"></script>
<script type="text/javascript" src="jquery/passwordverify.js"></script>

<div class="search">
    <form action="procurar.php" method="POST">
        <table>
            <tr>
                <td><center><input type="text" size="30" name="procurar" id="procurar" title="Procurar" value="Procurar " onfocus="apagarp()" onblur="escreverp()" />
                <input type="submit" class="btnproc" size="5" title="Procurar" value="" name="btnproc" /></center></td>
            </tr>
        </table>
    </form>
</div>

<div class="hyper">
    <div class="menu">
        <ul>
            <strong><li><a title="Home" href="index.php">Home</a></li></strong>
            <strong><li><a title="Contactos" href="contacto.php">Contactos</a></li></strong>
            <strong><li><a title="Sobre" href="sobre.php">Sobre</a></li></strong>
         </ul>
    </div>
</div>

<div class="leftarea">
    <div class="wikingon">
        <a href="index.php" style="background-color: transparent;">
            <img src="images/wikingon.png" alt="wikingon!" border="0"/>
        </a>
    </div>

    <?php
    if (isset($_SESSION['user'])){
    ?>
    <div class = "signlog">
        <center>
            <table>
                <tr>
                    <td><center><strong><?php echo $_SESSION['user']; ?></strong></center></td>
                </tr>

                <form action="userarea.php" method="POST">
                    <tr>
                        <td><center><input type="submit" class="botao" value="Area de Utilizador" /></center></td>
                    </tr>
                </form>

                <form action="artigoscriados.php" method="POST">
                    <tr>
                        <td><center><input type="submit" class="botao" value="Artigos criados por si" /></center></td>
                    </tr>
                </form>

                <form action="index.php" method="POST">
                    <tr>
                        <td><center><input type="submit" name="logout" class="botao" value="Sair" /></center></td>
                    </tr>
                </form>

                <form action="criarartigo.php" method="POST">
                    <tr>
                        <td><center><input type="submit" class="botao" value="Criar Artigo" /></center></td>
                    </tr>
                </form>
            </table>
        </center>
    </div>
    <?php
    }
    else{
    ?>
    <div class = "signlog">
        <center>
            <form action="index.php" method="POST">
                <table>
                    <tr>
                        <td><center><input type="text" size="21" id="user" name="user" title="Utilizador" value="Utilizador " onfocus="apagaru()" onblur="escreveru()" /></center></td>
                    </tr>
                    <tr>
                        <td><center><input type="password" size="21" id="user" name="pass" title="Password" value="Password " onfocus="apagarpw()" onblur="escreverpw()" /></center></td>
                    </tr>
                    <tr>
                        <td><center><input type="submit" class="botao" value="Entrar" /></center></td>
                    </tr>
                </table>
            </form>

            <form action="registar.php" method="POST">
                <table>
                    <tr>
                        <td><center><input type="submit" class="botao" value="Registar" /></center></td>
                    </tr>
                </table>
            </form>

            <form action="recuperarpass.php" method="POST">
                <table>
                    <tr>
                        <td><center><input type="submit" class="botao" value="Recuperar Password" /></center></td>
                    </tr>
                </table>
            </form>
        </center>
    </div>
    <?php
    }
    ?>
    <div class="fbtw">
        <a href="http://www.facebook.com/sharer.php?u=http://wikingon.com/&t=wikingon!" style="background-color: transparent;" title="Partilhar no Facebook">
            <img src="images/facebook.png" class="btnfacebook" alt="Partilhar no Facebook" border="0"/>
        </a>
        <a href="http://twitter.com/home?status=wikingon!: http://wikingon.com/&t=wikingon!" style="background-color: transparent;" title="Partilhar no Twitter">
            <img src="images/twitter.png" class="btntwitter" alt="Partilhar no Twitter" border="0"/>
        </a>
    </div>
</div>

<div class = "rightarea">
    

    <!--div class="feedback">
        <h1><img src="images/feedback.png" alt="Feedback" border="0" /></h1>
        <h5>
            <form action="feedback.php" method="request">
                <table>
                    <tr>
                        <td>De-nos o seu feedback e ajude-nos a melhorar.</td>
                    </tr>
                    <tr>
                        <td><input type="text" size="16" name="nome" id="nome" value="Nome " onfocus="apagarn()" onblur="escrevern()" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" size="16" name="mail" id="mail" value="E-mail " onfocus="apagarm()" onblur="escreverm()" /></td>
                    </tr>
                    <tr>
                        <td><textarea rows="5" name="txtfeed" id="txtfeed" onfocus="apagarc()" onblur="escreverc()" >Coment�rios </textarea></td>
                    </tr>
                    <tr>
                        <td><input type="submit" value="Enviar" /></td>
                    </tr>
                </table>
            </form>
        </h5>
    </div-->
</div>

<div class="bottomarea">
    <a href="http://www.geektuga.com/">GeekTuga</a> Productions <?php echo '&copy; ' . date("Y"); ?> (<a href="versao.php">versão</a>)
    <!--?php include 'foot.php'; ?-->
</div>

<script type="text/javascript">
    function apagarp(){
        if(document.getElementById("procurar").value=="Procurar ")
            document.getElementById("procurar").value="";
    }
    function escreverp(){
        if(document.getElementById("procurar").value=="")
                document.getElementById("procurar").value="Procurar ";
    }

    function apagarn(){
        if(document.getElementById("nome").value=="Nome ")
                document.getElementById("nome").value="";
    }
    function escrevern(){
        if(document.getElementById("nome").value=="")
                document.getElementById("nome").value="Nome ";
    }

    function apagarm(){
        if(document.getElementById("mail").value=="E-mail ")
                document.getElementById("mail").value="";
    }
    function escreverm(){
        if(document.getElementById("mail").value=="")
                document.getElementById("mail").value="E-mail ";
    }

    function apagarc(){
        if(document.getElementById("txtfeed").value=="Comentários ")
                document.getElementById("txtfeed").value="";
    }
    function escreverc(){
        if(document.getElementById("txtfeed").value=="")
                document.getElementById("txtfeed").value="Comentários ";
    }

    function apagaru(){
        if(document.getElementById("user").value=="Utilizador ")
                document.getElementById("user").value="";
    }
    function escreveru(){
        if(document.getElementById("user").value=="")
                document.getElementById("user").value="Utilizador ";
    }

    function apagarpw(){
        if(document.getElementById("pass").value=="Password ")
                document.getElementById("pass").value="";
    }
    function escreverpw(){
        if(document.getElementById("pass").value=="")
                document.getElementById("pass").value="Password ";
    }
</script>