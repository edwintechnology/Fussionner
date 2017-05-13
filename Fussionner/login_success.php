<?php
session_start();
$_SESSION['reguname'] = $_POST['username'];
if(!session_is_registered(myusername)){
header("location:http:/localhost/index.html");
}
header("Location: account_home.php");
?>
