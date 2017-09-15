<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
$query="select e.event_name, e.event_date_time, e.venue, c.client_name from
               event e join client_ref c on e.client_id=c.client_id where 
               e.event_date_time > date(now()) and e.status = 'Reserved' 
               order by e.event_date_time";
$result=mysqli_query($dbc,$query);
echo '<h1> Upcoming Events </h1>';
echo '<table width="75%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Event Name
</div></b></td>
<td width="10%"><div align="center"><b>Event Date
</div></b></td>
<td width="10%"><div align="center"><b>Venue
</div></b></td>
<td width="10%"><div align="center"><b>Client Name
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['event_date_time']}
</div></td>
<td width=\"50%\"><div align=\"center\">{$row['venue']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['client_name']}
</div></td>
</tr>";
}
echo '</table>';
echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
if($_SESSION['account_type']=="Employee"){
    if($_SESSION['title']=="Chef"){
      echo'   <br><br><br><br>
     <div align="left"><a href="chefmenu.php">Return</a>';
    }
     if($_SESSION['title']=="Inventory Manager"){
      echo'   <br><br><br><br>
     <div align="left"><a href="inventorymanagermenu.php">Return</a>';
    }

}
if($_SESSION['account_type']=="Admin"){
 echo'   <br><br><br><br>
<div align="left"><a href="menu.php">Return</a>';}
?>
