<?php
session_start();
       
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['account_id'])){
  $account_id=FALSE;
  $message.='<p>You forgot to enter the account id!';
 }else
  $account_id=$_POST['account_id'];

 if (empty($_POST['account_password'])){
  $account_password=NULL;
  $message.='<p>You forgot to enter the password!';
 }else
  $account_password=$_POST['account_password'];

if (empty($_POST['account_password2'])){
  $account_password2=NULL;
  $message.='<p>Please confim password!';
 }
 if ($_POST['account_password2'] != $_POST['account_password']){
  $account_password2=NULL;
  $message.='<p>Passwords do not match!';
 }else
  $account_password2=$_POST['account_password2'];

 if (empty($_POST['client_name'])){
  $client_name=NULL;
  $message.='<p>You forgot to enter the client name!';
 }else
  $client_name=$_POST['client_name'];

 if (empty($_POST['tel_no'])){
  $tel_no=NULL;
  $message.='<p>You forgot to enter the telephone number!';
 }else
  $tel_no=$_POST['tel_no'];

if (empty($_POST['fax_no'])){
  $fax_no=FALSE;
  $message.='<p>You forgot to enter the fax number!';
 }else
  $fax_no=$_POST['fax_no'];
 
 if (empty($_POST['mob_no'])){
  $mob_no=NULL;
  $message.='<p>You forgot to enter the mobile number!';
 }else
  $mob_no=$_POST['mob_no'];

if (empty($_POST['email'])){
  $email=FALSE;
  $message.='<p>You forgot to enter the email address!';
 }else
  $email=$_POST['email'];

 if (empty($_POST['address'])){
  $address=NULL;
 }else
  $address=$_POST['address'];

if(!isset($message)){
require_once('../mysql_connect.php');
$flag=1;
$query="select account_id from account where account_id='{$account_id}'";
$result=mysqli_query($dbc,$query);
if ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
$message.="<b><p>Account ID: {$account_id} already exists! Please input another!";}
else{
$query="insert into account (account_id,account_password,account_type) 
        values ('{$account_id}',PASSWORD('$account_password'),'Customer')";
$result=mysqli_query($dbc,$query);

$query2="insert into client_ref (client_name, tel_no, fax_no, mob_no, email, address, client_id) 
         values ('{$client_name}','{$tel_no}','{$fax_no}', '{$mob_no}', '{$email}', '{$address}', 
                 '{$account_id}')";
$result2=mysqli_query($dbc,$query2);

}
}
 

}

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Create New Customer Account: </legend>

<p>Account ID: <input type="text" name="account_id" size="20" maxlength="30" value="<?php if (isset($_POST['$account_id']) && !$flag) echo $_POST['$account_id']; ?>"/>
<p>Password: <input type="password" name="account_password" size="20" maxlength="30" value="<?php if (isset($_POST['$account_password']) && !$flag) echo $_POST['$account_password']; ?>"/>
<p>Confirm Password: <input type="password" name="account_password2" size="20" maxlength="30" value="<?php if (isset($_POST['$account_password2']) && !$flag) echo $_POST['$account_password2']; ?>"/>
<p>Client Name: <input type="text" name="client_name" size="20" maxlength="30" value="<?php if (isset($_POST['$client_name']) && !$flag) echo $_POST['$client_name']; ?>"/>
<p>Telephone No.: <input type="text" name="tel_no" size="20" maxlength="30" value="<?php if (isset($_POST['$tel_no']) && !$flag) echo $_POST['$tel_no']; ?>"/>
<p>Fax No.: <input type="text" name="fax_no" size="20" maxlength="30" value="<?php if (isset($_POST['$fax_no']) && !$flag) echo $_POST['$fax_no']; ?>"/>
<p>Mobile No: <input type="text" name="mob_no" size="20" maxlength="30" value="<?php if (isset($_POST['$mob_no']) && !$flag) echo $_POST['$mob_no']; ?>"/>
<p>Email Address: <input type="text" name="email" size="20" maxlength="30" value="<?php if (isset($_POST['$email']) && !$flag) echo $_POST['$email']; ?>"/>
<p>Address: <input type="text" name="address" size="20" maxlength="30" value="<?php if (isset($_POST['$address']) && !$flag) echo $_POST['$address']; ?>"/>

<div align="center"><input type="submit" name="submit" value="Create Account" /></div>
<a href="addaccountmenu.php">Return</a> <br>
</fieldset>
</form>
<p>

