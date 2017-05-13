<?php // listChecks.php
include("connection.php");

$result = mysql_query("SELECT name, check_number, date, amount, accountNumber FROM mychecks");
echo "<center><h1>Checking</h1></center>";
echo "<center><table border='1'>
<tr>
<th>Name:</th>
<th>Date:</th>
<th>Amount:</th>
<th>Account Number</th>
<th>Check Number:</th>
</tr>";

while($row = mysql_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['date'] . "</td>"; 
echo "<td>" . $row['amount'] . "</td>";
echo "<td>" . $row['accountNumber'] . "</td>";
echo "<td>" . $row['check_number'] . "</td>";
echo "</tr>";
}
echo "</table></center>";

mysql_close($sConn);
?>