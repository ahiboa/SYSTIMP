<html>
<body>

<?php
session_start();
$confirmedid = $_SESSION['event_select'];
require_once('../mysql_connect.php');

$query="select c.client_name, p.payment_id, p.payment_event_id, e.event_name, p.totalprice, p.status, 
               p.date from payment p join event e on 
               p.payment_event_id=e.event_id join client_ref c on e.client_id=c.client_id
               where e.event_id = '{$confirmedid}'";
$result=mysqli_query($dbc,$query);
echo '<h2> Payment Confirmed </h2>';
echo '<table width="75%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Client Name
</div></b></td>
<td width="10%"><div align="center"><b>Payment ID
</div></b></td>
<td width="10%"><div align="center"><b>Event Name
</div></b></td>
<td width="10%"><div align="center"><b>Price
</div></b></td>
<td width="1%"><div align="center"><b>Status
</div></b></td>
<td width="20%"><div align="center"><b> Issue Date
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['client_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['payment_event_id']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['totalprice']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row['status']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row['date']}
</div></td>
</tr>";
}
echo '</table>';


?>

<a href="menu.php">Return</a>   


