<?php
session_start();
$confirmedid = $_SESSION['event_select'];
require_once('../mysql_connect.php');
$query2="select c.client_name, e.event_name, e.venue, e.event_date_time, e.event_type, e.totalpax 
                from event e join client_ref c on e.client_id=c.client_id
                where e.event_id = '{$confirmedid}'";
$result2=mysqli_query($dbc,$query2);
echo '<h3> Event Details </h3>';
echo '<table width="75%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Client Name
</div></b></td>
<td width="10%"><div align="center"><b>Event Name
</div></b></td>
<td width="10%"><div align="center"><b>Venue
</div></b></td>
<td width="10%"><div align="center"><b>Event Date
</div></b></td>
<td width="10%"><div align="center"><b>Event Type
</div></b></td>
<td width="20%"><div align="center"><b>Number of Persons
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['client_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['venue']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['event_date_time']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row['event_type']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row['totalpax']}
</div></td>
</tr>";
}
echo '</table>';
echo '<br><br>';
$query3="select e.centerpiece, e.flowers, e.linencolor, e.others, p.package_name
                from event e join package p on p.package_id=e.package_id
                where e.event_id = '{$confirmedid}'";
$result3=mysqli_query($dbc,$query3);
echo '<h3> Order Details </h3>';
echo '<table width="75%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Centerpiece
</div></b></td>
<td width="10%"><div align="center"><b>Flowers
</div></b></td>
<td width="10%"><div align="center"><b>Linen Color
</div></b></td>
<td width="10%"><div align="center"><b>Others
</div></b></td>
<td width="10%"><div align="center"><b>Package Order
</div></b></td>
</tr>';

while($row2=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row2['centerpiece']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row2['flowers']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row2['linencolor']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row2['others']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row2['package_name']}
</div></td>
</tr>";
}
echo '</table>';
echo '<br><br><br><br>';
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p>Price per Head: <input type="text" name="price" size="20" maxlength="30" value="<?php if (isset($_POST['$price']) && !$flag) echo $_POST['$price']; ?>"/>
<div align="center"><input type="submit" name="submit" value="Approve Event"/></div>

<?php
if (isset($_POST['submit'])){
    if(empty($_POST['price'])){
        $price = false;
        echo "Please specify price";
    }
    else{
    $price = $_POST['price'];
    $query2= "update event
              set status = 'Approved', priceperhead = '{$price}'
              where event_id = '{$confirmedid}'";
    $result2=mysqli_query($dbc,$query2);
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/approveevent.php");
}
}
?>