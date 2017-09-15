<html>
<body>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<p>Payment Detail ID: <input type="text" name="payment_id" size="20" maxlength="30" value="<?php if (isset($_POST['$payment_id']) && !$flag) echo $_POST['$payment_id']; ?>"/>
<a href="menu.php">Return</a>

<?php
session_start();

if (empty($_POST['payment_id'])){
   $payment_id=FALSE;  
}

else{
    $payment_id=$_POST['payment_id'];

require_once('../mysql_connect.php');
$query="select c.client_name, p.payment_id, e.event_name, p.totalprice, 
               p.date, p.payment_type from payment p join event e on 
               p.payment_event_id=e.event_id join client_ref c on e.client_id=c.client_id
               where payment_id = '{$payment_id}' and p.status = 'Paid'";
$result=mysqli_query($dbc,$query);
echo '<h1> Customer Receipt </h1>';
echo '<table width="70%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Client Name
</div></b></td>
<td width="10%"><div align="center"><b>Payment ID
</div></b></td>
<td width="10%"><div align="center"><b>Event Name
</div></b></td>
<td width="10%"><div align="center"><b>Price
</div></b></td>
<td width="20%"><div align="center"><b>Date
</div></b></td>
<td width="50%"><div align="center"><b>Payment Method
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
if($row['payment_id'] == $_POST['payment_id']){
echo "<tr>
<td width=\"15%\"><div align=\"center\">{$row['client_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['payment_id']}
</div></td>
<td width=\"25%\"><div align=\"center\">{$row['event_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['totalprice']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['date']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['payment_type']}
</div></td>
</tr>";
}
}
echo '</table>';


}
?>