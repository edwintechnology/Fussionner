<?php // checkIO.php

$fp = fopen("sql1.txt", "r");
$handle = fread($fp, 255);
fclose($fp);
$name = substr($handle, 0, 20);
$name = trim($name);
$address = substr($handle, 20, 24);
$address = trim($address);
$date = substr($handle, 45, 10);
$date = trim($date);
$payIn = substr($handle, 55, 20);
$payIn = trim($payIn);
$amount = substr($handle, 75, 10);
$amount = trim($amount);
$memo = substr($handle, 85, 10);
$memo = trim($memo);
$routing = substr($handle, 95, 15);
$routing = trim($routing);
$accountNo = substr($handle, 110, 15);
$accountNo = trim($accountNo);
$checkNo = substr($handle, 125, 5);
$checkNo = trim($checkNo);

echo "<html>";
echo "<head>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/main.css\"></link>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/popup.css\"></link>";
echo "</head>";
echo "<body>";
echo "<form name=\"check\" action=\"insertCheck.php\" method=\"get\">";
echo "<table id=\"tableCheck\">";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Name:</td><td id=\"tdCheck\" colspan=\"2\"><input type=\"text\" name=\"name\" size=\"20\" value=\"".$name."\"></td>";
echo "<td id=\"tdCheck\" align=\"right\">Check No.: <input type=\"text\" name=\"check_num\" value=\"".$checkNo."\"></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Address:</td><td id=\"tdCheck\" colspan=\"2\"><input type=\"text\" name=\"address\" value=\"".$address."\"></td>";
echo "<td id=\"tdCheck\" align=\"right\">Date: <input type=\"text\" name=\"date\" value=\"".$date."\"></td></tr> <!-- may change to an option -->";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Pay to:</td><td id=\"tdCheck\" colspan=\"2\"> <input type=\"text\" name=\"payInorderTo\" size=\"63\" value=\"".$payIn."\"></td>";
echo "<td id=\"tdCheck\" align=\"right\">Amount: <input type=\"text\" name=\"amount\" value=\"".$amount."\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" colspan=\"4\"><input type=\"text\" size=\"115\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Memo:</td><td id=\"tdCheck\" colspan=\"2\"><input type=\"text\" name=\"memo\" value=\"".$memo."\"></td>";
echo "<td id=\"tdCheck\" align=\"right\">Sign:<input type=\"text\"></td></tr>";
echo "<tr id=\"trCheck\"><td align=\"right\">Routing:</td><td> <input type=\"text\" name=\"routing\" value=\"".$routing."\"></td>";
echo "<td id=\"tdCheck\">Account Number: <input type=\"text\" name=\"accountNumber\" value=\"".$accountNo."\"</td>";
echo "<td id=\"tdCheck\" align=\"right\"><input type=\"submit\" name=\"submit\" id=\"button\"></td></tr>";
echo "</table>";
echo "</body>";
echo "</html>";

?>