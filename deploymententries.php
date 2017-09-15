<?php
session_start();
require_once('../mysql_connect.php');
$confirmedid = $_SESSION['event_select'];

$query3="select c.client_name, e.centerpiece, e.flowers, e.linencolor, e.others, p.package_name
                from event e join package p on p.package_id=e.package_id join client_ref c on
                e.client_id=c.client_id
                where e.event_id = '{$confirmedid}'";
$result3=mysqli_query($dbc,$query3);
echo '<h3> Order Details </h3>';
echo '<table width="75%" border="1" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Client Name
</div></b></td>
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
<td width=\"10%\"><div align=\"center\">{$row2['client_name']}
</div></td>
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

<?php
require_once('../mysql_connect.php');
$query2="select category_no, category_name from category_ref where category_no <> 3";
$result2=mysqli_query($dbc,$query2);

?>

<form action="" method="post">

<p> Item Category:
<select name = "category_select">
<option selected = "selected">---Category---</option>
    <?php
        while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $category=$row2['category_no'];
            $category_name=$row2['category_name'];
            echo '<option value ="'.$category.'">'.$category_name.'</option>';
        }
    ?>
</select>
<input type="submit" name="view" value="Proceed to Inventory" />
<input type="submit" name="finish" value="Finished Recording" />

<?php
if (isset($_POST['view'])){
if (empty($_POST['category_select'])){
   echo "No category selected";  
}
else{
$_SESSION['category_select']=$_POST['category_select'];
header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/recorddeployed.php");
}
}

if (isset($_POST['finish'])){
header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/deployedinventory.php");
}


?>