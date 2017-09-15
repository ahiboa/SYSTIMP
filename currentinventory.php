<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
date_default_timezone_set('Asia/Manila');

$query2="select category_no, category_name from category_ref ";
$result2=mysqli_query($dbc,$query2);

?>
<form action="" method="post">

<p> Select Category:
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

<div align="center"><input type="submit" name="submit" value="View Report" /></div>

<?php
if (isset($_POST['submit'])){
if (empty($_POST['category_select'])){
   $category=FALSE;  
}

else{
    $category=$_POST['category_select'];
    $query="select i.inventory_id, i.inventory_name, c.category_name,  
         i.quantity from inventory i
         join category_ref c on i.category=c.category_no where i.category = '{$category}'";
$result=mysqli_query($dbc,$query);
echo '<div align = "center"><h3> Current Inventory </h3>';
echo '<table width="25%" border="1" align="Center" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Inventory ID
</div></b></td>
<td width="20%"><div align="center"><b>Item Name
</div></b></td>
<td width="15%"><div align="center"><b>Category
</div></b></td>
<td width="10%"><div align="center"><b>Quantity
</div></b></td>
</tr>';
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['inventory_id']}
</div></td>
<td width=\"20%\"><div align=\"center\">{$row['inventory_name']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['category_name']}
</div></td>
<td width=\"10%\"><div align=\"center\">{$row['quantity']}
</div></td>
</tr>";
}
echo '</table>';
echo '<div align="center">*END OF REPORT*'; echo '<br>';
echo date("Y-m-d H:i:s");
}

}

if($_SESSION['account_type']=="Employee"){
 echo'   <br><br><br><br>
<div align="left"><a href="inventorymanagermenu.php">Return</a>';
}
if($_SESSION['account_type']=="Admin"){
 echo'   <br><br><br><br>
<div align="left"><a href="inventoryreportmenu.php">Return</a>';
}

?>


