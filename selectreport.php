<html>
<body>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

<p>Select Date Start (YYYY-MM-DD HH:MM:SS): <input type="text" name="date_start" size="20" maxlength="30" value="<?php if (isset($_POST['$date_start']) && !$flag) echo $_POST['$date_start']; ?>"/>
<p>Select Date End (YYYY-MM-DD HH:MM:SS): <input type="text" name="date_end" size="20" maxlength="30" value="<?php if (isset($_POST['$date_end']) && !$flag) echo $_POST['$date_end']; ?>"/>
<div align="center"><input type="submit" name="view" value="View" /></div>

<?php
session_start();
date_default_timezone_set('Asia/Manila');

if (isset($_POST['view'])){
if (empty($_POST['date_start'])){
   $date_start=FALSE;  
}

else{
    $date_start=$_POST['date_start'];
}
if (empty($_POST['date_end'])){
   $date_end=FALSE;  
}

else{
    $date_end=$_POST['date_end'];
}
require_once('../mysql_connect.php');
$query="select  count(daily_id) as 'totalCustomers', date, sum(totalprice) as 'totalsales' from dailysales where date between '{$date_start}' and '{$date_end}' group by date";
$result=mysqli_query($dbc,$query);
echo '<div align = "center"><h3>Date Report</h3>';
echo '<table width="25%" border="1" align="Center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="20%"><div align="center"><b>Total Customers 
</div></b></td>
<td width="20%"><div align="center"><b>Date
</div></b></td>
<td width="20%"><div align="center"><b>Total Sales(Php)
</div></b></td>
</tr>';
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"15%\"><div align=\"center\">{$row['totalCustomers']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['date']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['totalsales']}
</div></td>
</tr>";
}
echo '</table>';
echo '<div align="center">*END OF REPORT*';
echo '<br>';
echo "TIME GENERATED: ".date("Y-m-d H:i:s");
}
?>
<br><br><br><br>
<div align="left"><a href="salesreportmenu.php">Return</a>

