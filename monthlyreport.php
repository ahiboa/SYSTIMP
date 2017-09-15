<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
date_default_timezone_set('Asia/Manila');

$query2="select month_no, month_name from month_ref";
$result2=mysqli_query($dbc,$query2);

?>
<form action="" method="post">

<p> Select Month:
<select name = "month_select">
<option value=""></option>
    <?php
        while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $month_no=$row2['month_no'];
            $month_name=$row2['month_name'];
            echo '<option value ="'.$month_no.'">'.$month_name.'</option>';
        }
    ?>
</select>

<div align="center"><input type="submit" name="submit" value="View Report" /></div>

<?php
if (isset($_POST['submit'])){
if (empty($_POST['month_select'])){
   $month_no=FALSE;  
   echo 'No Month Selected';
}

else{
    $month_no=$_POST['month_select'];
    $query="select count(daily_id) as 'totalCustomers', date, sum(totalprice) as 'totalsales' from dailysales where month(date) = '{$month_no}' group by date(date)";
$result=mysqli_query($dbc,$query);
echo '<div align = "center"><h3> Monthly Sales Report </h3>';
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

}
?>

<br><br><br><br>
<div align="left"><a href="salesreportmenu.php">Return</a>

