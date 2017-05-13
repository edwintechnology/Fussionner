<?php // insertAccount.php
include("connection.php");

$userName = 'gera';
$accountNumber = '$_POST['accountNumber']'
$accountName = $_POST['accountName'];
$type = $_POST['accountType'];
$name = (int)$_POST['balance'];
$limit = (int)$_POST['creditLimit'];

$dbQuery = "INSERT INTO myaccounts (accountNumber, username, accountname, type, balance, creditline) VALUES ('$accountNumber', '$userName', '$accountName', '$type', '$name', $limit)";
mysql_query($dbQuery) or die(mysql_error());

header("location: account_home.php");
?>
