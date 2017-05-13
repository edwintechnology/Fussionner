<?php
session_start(); 
include("connection.php");
include("error.php");

function usernameTaken($username){
   global $sConn;
   if(!get_magic_quotes_gpc()){
      $username = addslashes($username);
   }
   $query = "select username from users where username = '$username'";
   $result = mysql_query($query,$sConn);
   return (mysql_num_rows($result) > 0);
}
function addNewUser($username, $password, $firstname, $lastname){
   global $sConn;
   $query = "INSERT INTO users (firstname, lastname, username, password) VALUES ('$firstname', '$lastname', '$username', '$password')";
   return mysql_query($query,$sConn);
}

if(isset($_POST['join'])){
   if(!$_POST['username'] || !$_POST['password']){
      error('You didn\'t fill in a required field.');
   }

   $_POST['username'] = trim($_POST['username']);
   if(strlen($_POST['user']) > 32){
      error("Sorry, the username is longer than 32 characters, please shorten it.");
   }

   if(usernameTaken($_POST['username'])){
      $use = $_POST['username'];
      error("Sorry, the username: $use is already taken, please pick another one.");
   }

   $md5pass = md5($_POST['password']);
   $_SESSION['reguname'] = $_POST['username'];
   $_SESSION['regresult'] = addNewUser($_POST['username'], $md5pass, $_POST['firstname'], $_POST['lastname']);
   $_SESSION['registered'] = true;
session_register("username");
	session_register("password");
   echo "<meta http-equiv=\"Refresh\" content=\"0;url=$HTTP_SERVER_VARS[PHP_SELF]\">";
   return;
}
header("Location: account_home.php");
?>