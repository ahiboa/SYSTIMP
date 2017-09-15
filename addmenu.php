<?php
session_start();
require_once('../mysql_connect.php');
$query="select package_id, package_name from package";
$result=mysqli_query($dbc,$query);

if (isset($_POST['submit']))
{
	$message=NULL;
    if(empty($_POST['package']))
	{
		$message.="<p>You forgot to enter the item's name!";
	}
	else{
	   $package = $_POST['package'];
	}

	if(empty($_POST['name']))
	{
		$message.="<p>You forgot to enter the item's name!";
	}
	else{
	   $name = $_POST['name'];
	}
	
	if(!isset($message))
	{
		$query2="insert into menu (item_name, package_id) 
		values ('{$name}','{$package}')";
		$result2=mysqli_query($dbc,$query2);
		$message.="<p>Menu item added!";

	}
}
if (isset($_POST['view']))
{
	header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/viewpackages.php");
}
if (isset($_POST['create']))
{
	header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/addpackage.php");
}
if (isset($message))
{
 echo '<font color="red">'.$message. '</font>';
}
?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<div align="center"><input type="submit" name="view" value="View Existing Packages" /> <input type="submit" name="create" value="Create New Package" /></div>
<fieldset><legend>Create Package</legend>
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
<p>Item name: <input type="text" name="name" size="20" maxlength="30" value="<?php if (isset($_POST['$name']) && !$flag) echo $_POST['$name']; ?>"/>

<div align="center"><input type="submit" name="submit" value="Add to Package" /></div>
</fieldset>
<a href="chefmenu.php">Return</a>
</form>
<p>

