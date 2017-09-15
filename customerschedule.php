<html>
<body>

<?php
session_start();
$sessionid = $_SESSION['account_id'];
require_once('../mysql_connect.php');
$query="select e.event_name, e.event_date_time, e.venue from
               event e join package p on e.package_id=p.package_id join client_ref c on c.client_id=e.client_id
               where c.client_id = '{$sessionid}' and e.event_date_time > now() 
               order by e.event_date_time";
$result=mysqli_query($dbc,$query);
echo '<h1>---History---</h1>';
echo '<table width="75%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Event Name
</div></b></td>
<td width="10%"><div align="center"><b>Event Date
</div></b></td>
<td width="10%"><div align="center"><b>Venue
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['event_date_time']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['venue']}
</div></td>
</tr>";
}
echo '</table>';


?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<a href="customermenu.php">Return</a>