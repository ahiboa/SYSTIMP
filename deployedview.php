<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
$query="select c.client_name, e.event_name, e.event_date_time, i.inventory_name, ed.quantity
        from event e join client_ref c on e.client_id=c.client_id join event_deployment ed on
        e.event_id=ed.event_deployed join inventory i on ed.inventory_deployed=i.inventory_id
        where  ed.status = 'Deployed' and e.event_date_time > now()
        order by c.client_name";
$result=mysqli_query($dbc,$query);
echo date("Y-m-d H:i:s");
echo '<br>';
echo '<div align = "center"><h3> Items Deployed </h3>';
echo '<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="20%"><div align="center"><b>Client Name
</div></b></td>
<td width="20%"><div align="center"><b>Event Name
</div></b></td>
<td width="20%"><div align="center"><b>Event Date
</div></b></td>
<td width="25%"><div align="center"><b>Inventory Name
</div></b></td>
<td width="25%"><div align="center"><b>Quantity
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"15%\"><div align=\"center\">{$row['client_name']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['event_date_time']}
</div></td>
<td width=\"25%\"><div align=\"center\">{$row['inventory_name']}
</div></td>
<td width=\"25%\"><div align=\"center\">{$row['quantity']}
</div></td>
</tr>";
}
echo '</table>';
echo'<br><br><br><br>';
?>

<div align="left"><a href="inventorymanagermenu.php">Return</a>


