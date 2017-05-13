<?php

global $blobId;

if(!is_numeric($blobId))
die("Invalid blobId specified");

// Database connection variables

$dbServer = "america2k.ipowermysql.com";
$dbDatabase = "cs365";
$dbUser = "wolf";
$dbPass = "cs365";



$sConn = mysql_connect($dbServer, $dbUser, $dbPass)
or die("Couldn't connect to database server");

$dConn = mysql_select_db($dbDatabase, $sConn)
or die("Couldn't connect to database $dbDatabase");



$dbQuery = "SELECT blobType, blobData FROM myBlobs WHERE blobId = $blobId";

$result = mysql_query($dbQuery) or die("Couldn't get file list");



if(mysql_num_rows($result) == 1){

$fileType = @mysql_result($result, 0, "blobType");
$fileContent = @mysql_result($result, 0, "blobData");
header("Content-type: $fileType");
echo $fileContent;

}

else

{

echo "Record doesn't exist.";

}
?>
