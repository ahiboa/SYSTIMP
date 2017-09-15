<?php
session_start();
if (isset($_POST['submit']))
{
	$message=NULL;
	if(empty($_POST['name']))
	{
		$message.="<p>You forgot to enter the recipe's name!";
	}
	else
		$_SESSION['recipename'] = $_POST['name'];
	
	if(!isset($message))
	{
		header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/addingredient.php");
	}
}

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add Recipe</legend>
<p>Recipe name: <input type="text" name="name" size="20" maxlength="30" value="<?php if (isset($_POST['$name']) && !$flag) echo $_POST['$name']; ?>"/>

<div align="center"><input type="submit" name="submit" value="Create" /></div>
<a href="chefmenu.php">Return</a>
</fieldset>
</form>
<p>

