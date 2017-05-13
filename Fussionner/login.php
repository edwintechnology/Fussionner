<?php //login.php
include("connection.php");
include("error.php");

$username = $_POST['username'];
$password = $_POST['password'];

$mypass = md5($password);

$sql="SELECT * FROM users WHERE username = '$username' AND password='$mypass'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);

if($count == 1){
	session_register("username");
	session_register("password");
	header("location: login_success.php");
}
else{
	
	error("Wrong Username or Password");
}
?>