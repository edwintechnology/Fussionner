<?php // insertCheck.php
include("connection.php");
session_start();
$username = $_SESSION["username"];

$checkNum = (int)$_GET['check_num'];
$amt = (double)$_GET['amount'];
$name = $_GET['name'];
$address = $_GET['address'];
$date = $_GET['date'];
$payIn = $_GET['payInorderTo']; 
$memo = $_GET['memo']; 
$routing = $_GET['routing'];
$accountNumber = $_GET['accountNumber'];

$dbQuery = "INSERT INTO mychecks (name, address, date, payInOrderTo, amount, memo, routing, accountNumber, check_number, username) VALUES ('$name', '$address', '$date', '$payIn', $amt, '$memo', '$routing', '$accountNumber', '$checkNum', '$username')";
mysql_query($dbQuery) or die(mysql_error());

header("location: account_home.php");
?>