<?php // fileIO

$fp = fopen("sql2.txt", "r");
$handle = fread($fp, 65);
fclose($fp);
$invoice = substr($handle, 0, 15);
$invoice = trim($invoice);
$store = substr($handle, 15, 15);
$store = trim($store);
$amt = substr($handle, 30, 10);
$amt = trim($amt);
$method = substr($handle, 40, 10);
$method = trim($method);

echo "<html>";
echo "<head>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/main.css\"></link>";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"style/popup.css\"></link>";
echo "</head>";
echo "<body>";
echo "<form name=\"receipt\" action=\"insertReceipt.php\" method=\"get\">";
echo "<table id=\"tableCheck\">";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Store Name:</td><td id=\"tdCheck\"><input type=\"text\" value=\"".$store."\" name=\"storeName\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Invoice Number:</td><td id=\"tdCheck\"><input type=\"text\" value=\"".$invoice."\" name=\"invoice\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item1:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item2:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item3:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Item4:</td><td id=\"tdCheck\"><input type=\"text\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Total Amount:</td><td id=\"tdCheck\"><input type=\"text\" value=\"".$amt."\" name=\"amount\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\" align=\"right\">Pay Method:</td><td id=\"tdCheck\"><input type=\"text\" value=\"".$method."\" name=\"payMethod\"></td></tr>";
echo "<tr id=\"trCheck\"><td id=\"tdCheck\"></td><td id=\"tdCheck\"><input type=\"submit\" name=\"submit\" id=\"button\">";
echo "</table></form></body></html>";