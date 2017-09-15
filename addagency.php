<?php
session_start();
       
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['agency_name'])){
  $agency_name=FALSE;
  $message.='<p>You forgot to enter the agency!';
 }else
  $agency_name=$_POST['agency_name'];

 if (empty($_POST['address'])){
  $address=NULL;
  $message.='<p>You forgot to enter the address!';
 }else
  $address=$_POST['address'];

if(!isset($message)){
require_once('../mysql_connect.php');
$flag=1;
$query="select agency_name from agency where agency_name='{$agency_name}'";
$result=mysqli_query($dbc,$query);
if ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$message.="<b><p>Account ID: {$agency_name} already exists!";}
else{
$query="insert into agency (agency_name, address) 
        values ('{$agency_name}','{$address}')";
$result=mysqli_query($dbc,$query);
}
}

}

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add agency </legend>

<p>Agency Name: <input type="text" name="agency_name" size="20" maxlength="30" value="<?php if (isset($_POST['$agency_name']) && !$flag) echo $_POST['$agency_name']; ?>"/>
<p>Address: <input type="text" name="address" size="20" maxlength="30" value="<?php if (isset($_POST['$address']) && !$flag) echo $_POST['$address']; ?>"/>
<div align="center"><input type="submit" name="submit" value="Record Agency" /></div>
<a href="addaccountmenu.php">Return</a> <br>
</fieldset>
</form>
<p>

