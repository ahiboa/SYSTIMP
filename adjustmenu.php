<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
$query="select distinct item_name from menu";
$result=mysqli_query($dbc,$query);

?>
<fieldset><legend>Menu Adjustment</legend>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<p> Menu Items:
<select name = "menu">
<option value=""></option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $name=$row['item_name'];
            echo '<option value ="'.$name.'">'.$name.'</option>';
        }
    ?>
</select>
<input type="radio" name="availability" value="Available">Available
<input type="radio" name="availability" value="Pulled">Pulled
<input type="submit" name="confirm" value="Confirm"/> <a href="chefmenu.php">Return</a>
</fieldset>
<?php
if (isset($_POST['confirm']))
{
	$message=NULL;
    if(empty($_POST['menu']) OR empty($_POST['availability']))
	{
		$message.="<p>Please complete the details";
        echo $message;
	}
	else{
	   $name = $_POST['menu'];
       $availability = $_POST['availability'];
       $query2="update menu
                set availability = '{$availability}'
                where item_name = '{$name}'";
       $result2=mysqli_query($dbc,$query2);
}
}
?>


