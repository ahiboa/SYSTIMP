<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');

$query2="select distinct(recipe_name) from recipe_items";
$result2=mysqli_query($dbc,$query2);

?>
<form action="" method="post">

<p> Select Recipe:
<select name = "recipe">
<option selected = "selected">---Recipes---</option>
    <?php
        while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $recipe_name=$row2['recipe_name'];
            echo '<option value ="'.$recipe_name.'">'.$recipe_name.'</option>';
        }
    ?>
</select>
<input type="submit" name="submit" value="View Recipe" /> <a href="chefmenu.php">Return</a> <br> <br></div>

<?php
if (isset($_POST['submit'])){
if (empty($_POST['recipe'])){
   $recipe_name = FALSE;  
}

else{
    $recipe_name=$_POST['recipe'];
    $query="select ingredient_name, amount, measurement from recipe_items where recipe_name = '{$recipe_name}'";
$result=mysqli_query($dbc,$query);
echo '<div align = "left"><h3>Recipe</h3>';
echo '<table width="25%" border="1" align="Left" cellpadding="0" cellspacing="0" bordercolor="#000000">
<tr>
<td width="10%"><div align="center"><b>Ingredient Name
</div></b></td>
<td width="20%"><div align="center"><b>Quantity
</div></b></td>
<td width="15%"><div align="center"><b>Measurements
</div></b></td>
</tr>';
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
echo "<tr>
<td width=\"10%\"><div align=\"center\">{$row['ingredient_name']}
</div></td>
<td width=\"20%\"><div align=\"center\">{$row['amount']}
</div></td>
<td width=\"15%\"><div align=\"center\">{$row['measurement']}
</div></td>
</tr>";
}
echo '</table>';
}
}