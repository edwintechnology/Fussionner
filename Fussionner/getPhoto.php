<?php // getPhoto.php

include("connection.php");

$id = $_REQUEST['id'];
$dbQuery = "SELECT img_type, img_size, img_data FROM myphotos WHERE id = '$id'";
$result = mysql_query($dbQuery) or die("Couldn't get file list");

list($type, $size, $content) = mysql_fetch_array($result);

header('Content-length:' . $size);
header('Content-type: ' .type);
print $content;

?>