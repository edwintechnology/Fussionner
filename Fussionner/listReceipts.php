<?php // listreceipts.php
include("connection.php");

$result = mysql_query("SELECT * FROM myreceipts");
echo "<center><h1>Receipts</h1></center>";
echo "<center><table border='1'>
<tr>
<th>Store Name:</th>
<th>Invoice Number:</th>
<th>Amount:</th>
<th>Pay Method</th>
</tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['storeName'] . "</td>";
echo "<td>" . $row['invoiceNum'] . "</td>"; 
echo "<td>" . $row['amount'] . "</td>";
echo "<td>" . $row['payMethod'] . "</td>";
echo "</tr>";
}
echo "</table></center>";

mysql_close($sConn);
?>