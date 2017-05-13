<?php
include("connection.php");

$dbQuery = "SELECT id, img_name, img_type, img_size, img_data FROM myphotos ORDER BY id ASC";
$result = mysql_query($dbQuery) or die("Couldn't get file list");
$counter = 0;
echo "<table border=\"1\"><tr>";

while($row = mysql_fetch_array($result)){
	if($counter > 3){
		echo "</tr><tr>";
		$counter = 0;
	}
	echo "<td><img src=\"getPhoto.php?id=$row[id]\" width=\"150\" height=\"150\" /></td>";
	$counter = $counter+1;
}
echo "</tr></table>";
?>
