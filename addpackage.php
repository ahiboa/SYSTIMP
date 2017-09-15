<?php
session_start();
       
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['name'])){
  $name=FALSE;
  $message.='<p>No package created';
 }else
  $name=$_POST['name'];

if(!isset($message)){
require_once('../mysql_connect.php');
$flag=1;
$query="insert into package (package_name) 
        values ('{$name}')";
$result=mysqli_query($dbc,$query);

}
}
 
if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Create New Package Type: </legend>

<p>New Package Name: <input type="text" name="name" size="20" maxlength="30" value="<?php if (isset($_POST['$name']) && !$flag) echo $_POST['$name']; ?>"/>
<div align="center"><input type="submit" name="submit" value="Create Package" /></div>
<a href="addmenu.php">Return</a> <br>
</fieldset>
</form>
<p>

