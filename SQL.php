<?php

function view($tabela, $cond){
    include 'connect.php';
    if($cond!="")
        $result = mysql_query("SELECT * FROM " . $tabela . " WHERE " . $cond . "");
    else
        $result = mysql_query("SELECT * FROM " . $tabela . "");
    //$row = mysql_fetch_array($result);

    mysql_close($con);

    return $result;
}

/*
CREATE PROCEDURE inserirUser (n VARCHAR(50), u VARCHAR(50), m VARCHAR(50), p VARCHAR(50))
BEGIN
	INSERT INTO users (nome, username, mail, password)
        VALUES (n, u, m, p);
END
*/
function proc($tipo, $campos){
    include 'connect.php';
    switch ($tipo){
        case "registo":
            mysql_query("CALL inserirUser('" . $campos[0] . "', '" . $campos[1] . "', '" . $campos[2] . "', '" . $campos[3] . "');");
    }
    mysql_close($con);
}

?>
