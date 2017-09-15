<?php
session_start();
require_once('../mysql_connect.php');
if (isset($_SESSION['badlogin'])){
if ($_SESSION['badlogin']>=100)
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/blocked.php");
}

if (isset($_POST['submit'])){

$message=NULL;

if (empty($_POST['account_id'])){
   $account_id=FALSE;  
}

else{
     $_SESSION["account_id"]=$_POST['account_id'];
     $sessionid =  $_SESSION["account_id"];
}
if (empty($_POST['account_password'])){
   $account_password=FALSE;  
}

else{
    $account_password=$_POST['account_password'];
}
 
$query="select account_type from account 
        where account_id = '{$sessionid}' AND account_password = PASSWORD('$account_password')";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

$query2="select title from employee 
        where emp_id = '{$sessionid}'";
$result2=mysqli_query($dbc,$query2);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);

if ($row["account_type"]=="Admin") {
       $_SESSION['account_type']="Admin";
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/menu.php");
}
if ($row["account_type"]=="Employee" and $row2["title"] != "Chef" and $row["title"] != "Inventory Manager") {
       $_SESSION['account_type']="Employee";
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/empmenu.php");
}
if ($row["account_type"]=="Employee" and $row2["title"] == "Chef") {
       $_SESSION['account_type']="Employee";
       $_SESSION['title']="Chef";
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/chefmenu.php");
}
if ($row["account_type"]=="Employee" and $row2["title"] == "Inventory Manager") {
       $_SESSION['account_type']="Employee";
       $_SESSION['title']="Inventory Manager";
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/inventorymanagermenu.php");
}
else{
if ($row["account_type"]=="Customer") {
       $_SESSION['account_type']="Customer";
       header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/customermenu.php");
}else {
 $message.='<p>Please try again';
if (isset($_SESSION['badlogin']))
  $_SESSION['badlogin']++;
else
  $_SESSION['badlogin']=1;
}
} 
}/*End of main Submit conditional*/

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Please login below: </legend>

<p>User Name: <input type="text" name="account_id" size="20" maxlength="30" value="<?php if (isset($_POST['account_id'])) echo $_POST['account_id']; ?>"/>
<p>Password: <input type="password" name="account_password" size="20" maxlength="20" value="<?php if (isset($_POST['account_password'])) echo $_POST['account_password']; ?>"/>
<div align="center"><input type="submit" name="submit" value="Login" /></div>

</form>

