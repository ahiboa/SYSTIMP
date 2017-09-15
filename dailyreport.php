<html>
<body>

<?php
session_start();
date_default_timezone_set('Asia/Manila');
require_once('../mysql_connect.php');
$query="select * from dailysales where date(date) = date(now()) order by date";
$result=mysqli_query($dbc,$query);
echo "TIME: ".date("Y-m-d H:i:s");
echo '<br>';
echo '<div align = "center"><h3> Daily Report </h3>';
echo '<table width="65%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="20%"><div align="center"><b>Daily ID
</div></b></td>
<td width="20%"><div align="center"><b>Date
</div></b></td>
<td width="20%"><div align="center"><b>Total Sales(Php)
</div></b></td>
</tr>';

while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"15%\"><div align=\"center\">{$row['daily_id']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['date']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['totalPrice']}
</div></td>
</tr>";
}
echo '</table>';
echo '<div align="center">*END OF REPORT*';
echo '<br>';
echo "TIME GENERATED: ".date("Y-m-d H:i:s");

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div align='left'><a href="salesreportmenu.php">Return</a>

