<html>
<body>

<?php
session_start();
date_default_timezone_set('Asia/Manila');
require_once('../mysql_connect.php');
$query="select l.lost_id, i.inventory_name, l.lostquantity, l.date_reported
        from lost_inventory l join inventory i on l.inventory_id=i.inventory_id";
$result=mysqli_query($dbc,$query);
echo date("Y-m-d H:i:s");
echo '<br>';
echo '<div align = "center"><h3> Lost sInventory </h3>';
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="20%"><div align="center"><b>Lost ID
</div></b></td>
<td width="20%"><div align="center"><b>Item Name
</div></b></td>
<td width="20%"><div align="center"><b>Lost Quantity
</div></b></td>
<td width="25%"><div align="center"><b>Date Reported
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"15%\"><div align=\"center\">{$row['lost_id']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['inventory_name']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['lostquantity']}
</div></td>
<td width=\"25%\"><div align=\"center\">{$row['date_reported']}
</div></td>
</tr>";
}
echo '</table>';
echo '<div align="center">*END OF REPORT*';
echo '<br>';
echo "TIME GENERATED: ".date("Y-m-d H:i:s");

if($_SESSION['account_type']=="Employee"){
 echo'   <br><br><br><br>
<div align="left"><a href="inventorymanagermenu.php">Return</a>';
}
if($_SESSION['account_type']=="Admin"){
 echo'   <br><br><br><br>
<div align="left"><a href="inventoryreportmenu.php">Return</a>';
}
?>


