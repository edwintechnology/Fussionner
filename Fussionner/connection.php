<?php // connection.php
$dbServer = "america2k.ipowermysql.com";
$dbDatabase = "cs365";
$dbUser = "wolf";
$dbPass = "cs365";

//$dbServer = "localhost";
//$dbDatabase = "photobase";
//$dbUser = "root";
//$dbPass = "jessica3";

$sConn = mysql_connect($dbServer, $dbUser, $dbPass)
or die("Couldn't connect to database server");

$dConn = mysql_select_db($dbDatabase, $sConn)
or die("Couldn't connect to database $dbDatabase");


?>