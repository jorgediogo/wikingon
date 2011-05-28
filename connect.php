<?php
$con = mysql_connect("localhost:3306","geektuga_jorged","14274312e");
if (!$con){
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("geektuga_wikingon", $con);
?>
