<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
$query="select * from package";
$result=mysqli_query($dbc,$query);

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p> Package List:
<select name = "package">
<option value=""></option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $package_id=$row['package_id'];
            $package_name=$row['package_name'];
            echo '<option value ="'.$package_id.'">'.$package_name.'</option>';
        }
    ?>
</select>
<input type="submit" name="view" value="View Package"/> <a href="addmenu.php">Return</a>

<?php
if (isset($_POST['view']))
{
	$message=NULL;
    if(empty($_POST['package']))
	{
		$message.="<p>No package selected";
        echo $message;
	}
	else{
	   $package = $_POST['package'];
       $query2="select item_name, package_id from menu where package_id = '{$package}' and availability = 'Available'";
       $result2=mysqli_query($dbc,$query2);
      echo '<div align = "Left"><h3> Menu </h3>';
echo '<table width="15%" border="1" align="Left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Item Name
</div></b></td>
</tr>';
while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row2['item_name']}
</div></td>
    </tr>";
}
echo '</table>';
}
}
?>


