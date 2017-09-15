<?php
session_start();
$name = $_SESSION['recipename'];
if (isset($_POST['submit']))
{
	$message=NULL;
	if(empty($_POST['ing']))
	{
		$message.="<p>You forgot to enter the ingredient's name!";
	}
	if (empty($_POST['qty']))
	{
		$message.="<p>You forgot to enter the quantity of the ingredient!";
	}
	if (empty($_POST['mes']))
	{
		$message.="<p>You forgot to enter the measurement type of the ingredient!";
	}
	if(!isset($message))
	{
		$ing = $_POST['ing'];
		$qty = $_POST['qty'];
		$mes = $_POST['mes'];
		require_once('../mysql_connect.php');
		$flag=1;
		$query2="insert into recipe_items (recipe_name, ingredient_name,amount,measurement) 
		values ('{$name}','{$ing}','{$qty}','{$mes}')";
		$result2=mysqli_query($dbc,$query2);
		$message.="<p>Ingredient added!";
	}
}
if (isset($_POST['done']))
{
  header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/addrecipe.php");
}
if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add Ingredient</legend>
<p>Ingredient name: <input type="text" name="ing" size="20" maxlength="30" value="<?php if (isset($_POST['$ing']) && !$flag) echo $_POST['$ing']; ?>"/>
<p>Quantity: <input type="number" name="qty" size="20" maxlength="30" value="<?php if (isset($_POST['$qty']) && !$flag) echo $_POST['$qty']; ?>"/>
<p>Measurement: <input type="text" name="mes" size="20" maxlength="30" value="<?php if (isset($_POST['$mes']) && !$flag) echo $_POST['$mes']; ?>"/>

<div align="center"><input type="submit" name="submit" value="Add to Recipe" /></div>
<div align="left"><input type="submit" name="done" value="Done" /></div>
</fieldset>
</form>
<p>

