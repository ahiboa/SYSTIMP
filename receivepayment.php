<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');

$query="select e.event_id, e.event_name, e.event_date_time, c.client_name from
               event e join client_ref c on e.client_id=c.client_id join payment p 
               on e.event_id=p.payment_event_id where p.status = 'Pending' and e.status = 'Approved'";
$result=mysqli_query($dbc,$query);

?>
<form action="" method="post">


<p> Pending Events:
<select name = "event_select">
echo '<option value=""></option>';
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $event_id=$row['event_id'];
            $event_name=$row['event_name'];
            $date=$row['event_date_time'];
            $client_name=$row['client_name'];
            echo '<option value ="'.$event_id.'">'.$event_name." ".$date." ".$client_name.'</option>';
        }
    ?>
</select>

<input type="submit" name="view" value="View Details" />
<?php
if (isset($_POST['view'])){
if (empty($_POST['event_select'])){
    $confirmedid = FALSE;
   echo "No client selected";  
}
else{
$event_id=$_POST['event_select'];
$query2="select c.client_name, p.payment_id, p.payment_event_id, e.event_name, p.totalprice, 
               p.date from payment p join event e on 
               p.payment_event_id=e.event_id join client_ref c on e.client_id=c.client_id
               where e.event_id = '{$event_id}'";
$result2=mysqli_query($dbc,$query2);
echo '<h1> Confirm Details </h1>';
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
<td width="20%"><div align="center"><b> Issue Date
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['client_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['payment_event_id']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['totalprice']}
</div></td>
<td width=\"5%\"><div align=\"center\">{$row['date']}
</div></td>
</tr>";
}
echo '</table>';
echo '<br><br><br><br>';
echo '<div align="center"><input type="submit" name="confirm" value="Confirm" /></div>';
}
}
if (isset($_POST['confirm'])){
$_SESSION['event_select']=$event_id;
$confirmedid = $_SESSION['event_select'];
        $query3= "update payment
        set status = 'Paid', date = now()
        where payment_event_id = '{$confirmedid}'";
        $result3=mysqli_query($dbc,$query3);
        $query4= "update event
        set status = 'Reserved'
        where event_id = '{$confirmedid}'";
        $result4=mysqli_query($dbc,$query4);
        header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/confirmed.php");
}
?>

<a href="menu.php">Return</a>   