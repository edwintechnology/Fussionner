<?php // deleteAccount.php
include("connection.php");

$userName = 'gera';
$accountName = $_POST['accountName'];
$type = $_POST['accountType'];

$dbQuery = "DELETE FROM myaccounts WHERE username='$userName' AND accountname='$accountName' AND type='$type'";
mysql_query($dbQuery) or die(mysql_error());

header("location: account_home.php");
?>
