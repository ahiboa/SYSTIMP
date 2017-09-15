<html>
<body>
<?php
session_start();
require_once('../mysql_connect.php');

$query2="select client_name from client_ref";
$result2=mysqli_query($dbc,$query2);

?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<p> Clients:
<select name = "client_name">
echo '<option value=""></option>';
    <?php
        while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $client_name=$row2['client_name'];
            echo '<option value ="'.$client_name.'">'.$client_name.'</option>';
        }
    ?>
</select>
<input type="submit" name="view" value="View Details"/>
<a href="menu.php">Return</a>

<?php
if (isset($_POST['view'])){
if (empty($_POST['client_name'])){
   $client_name=FALSE;  
   echo "Please enter a client name";
}

else{
    $client_name=$_POST['client_name'];
}

if (isset($_POST["client_name"])){
require_once('../mysql_connect.php');
$query="select c.client_name, e.event_name, p.totalprice, p.status, 
               p.date, e.event_date_time from payment p join event e on 
               p.payment_event_id=e.event_id join client_ref c on e.client_id=c.client_id
               where c.client_name = '{$client_name}' and p.status = 'Paid'";
$result=mysqli_query($dbc,$query);
echo '<h1> Customer History</h1>';
echo '<table width="75%" border="1" align="left" cellpadding="10" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Client Name
</div></b></td>
<td width="10%"><div align="center"><b>Event Name
</div></b></td>
<td width="10%"><div align="center"><b>Event Date
</div></b></td>
<td width="10%"><div align="center"><b>Total Price
</div></b></td>
<td width="20%"><div align="center"><b> Status
</div></b></td>
<td width="20%"><div align="center"><b> Issue Date
</div></b></td>

</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
if($row['client_name'] == $_POST['client_name']){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['client_name']}
</div></td>
<td width=\"20%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"20%\"><div align=\"center\">{$row['event_date_time']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['totalprice']}
</div></td>
<td width=\"20%\"><div align=\"center\">{$row['status']}
</div></td>
<td width=\"20%\"><div align=\"center\">{$row['date']}
</div></td>
</tr>";
}
}
echo '</table>';
}
}


?>
