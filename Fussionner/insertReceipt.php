<?php // insertReceipt.php
include("connection.php");
session_start();
$username = $_SESSION["username"];
$invoiceNum = (int)$_GET['invoice'];
$storeName = $_GET['storeName'];
$amount = (double)$_GET['amount'];
$payMethod = $_GET['payMethod'];

$dbQuery = "INSERT INTO myreceipts (invoiceNum, storeName, amount, payMethod, username) VALUES ('$invoiceNum', '$storeName', '$amount', '$payMethod', '$username')";
mysql_query($dbQuery) or die(mysql_error());

header("location: account_home.php");

?>