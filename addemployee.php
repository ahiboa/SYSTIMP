<?php
session_start();
require_once('../mysql_connect.php');

$query3="select agency_id, agency_name from agency";
$result3=mysqli_query($dbc,$query3);
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

if (empty($_POST['agency'])){
   $agency_id=FALSE;  
   $message = '<p> Please select agency';
}
else
   $agency_id = $_POST['agency'];

 if (empty($_POST['contact_no'])){
  $contact_no=NULL;
  $message.='<p>You forgot to enter the contact number!';
 }else
  $contact_no=$_POST['contact_no'];

if (empty($_POST['email'])){
  $email=FALSE;
  $message.='<p>You forgot to enter the email address!';
 }else
  $email=$_POST['email'];

if (empty($_POST['emp_fn'])){
  $emp_fn=FALSE;
  $message.='<p>You forgot to enter the employee name!';
 }else
  $emp_fn=$_POST['emp_fn'];

 if (empty($_POST['emp_ln'])){
  $emp_ln=NULL;
  $message.='<p>You forgot to enter the employee name!';
 }else
  $emp_ln=$_POST['emp_ln'];

 if (empty($_POST['title'])){
  $title=NULL;
  $message.='<p>You forgot to enter the employee title!';
 }else
  $title=$_POST['title'];

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
        values ('{$account_id}',PASSWORD('$account_password'),'Employee')";
$result=mysqli_query($dbc,$query);

$query2="insert into employee (emp_id, agency_id,contact_no, email, emp_fn, emp_ln, title, address) 
         values ('{$account_id}','{$agency_id}','{$contact_no}', '{$email}', '{$emp_fn}', '{$emp_ln}', 
         '$_POST[title]', '{$address}')";
$result2=mysqli_query($dbc,$query2);

}
}
 

}

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Create New Employee Account </legend>

<p>Account ID: <input type="text" name="account_id" size="20" maxlength="30" value="<?php if (isset($_POST['$account_id']) && !$flag) echo $_POST['$account_id']; ?>"/>
<p>Password: <input type="password" name="account_password" size="20" maxlength="30" value="<?php if (isset($_POST['$account_password']) && !$flag) echo $_POST['$account_password']; ?>"/>
<p>Confirm Password: <input type="password" name="account_password2" size="20" maxlength="30" value="<?php if (isset($_POST['$account_password2']) && !$flag) echo $_POST['$account_password2']; ?>"/>
<p> Select Agency:
<select name = "agency">
<option value=""></option>
    <?php
        while($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
            $agency_id=$row3['agency_id'];
            $agency_name=$row3['agency_name'];
            echo '<option value ="'.$agency_id.'">'.$agency_name.'</option>';
        }
    ?>
</select>
<p>Contact No.: <input type="text" name="contact_no" size="20" maxlength="30" value="<?php if (isset($_POST['$contact_no']) && !$flag) echo $_POST['$contact_no']; ?>"/>
<p>Email Address: <input type="text" name="email" size="20" maxlength="30" value="<?php if (isset($_POST['$email']) && !$flag) echo $_POST['$email']; ?>"/>
<p>First Name: <input type="text" name="emp_fn" size="20" maxlength="30" value="<?php if (isset($_POST['$emp_fn']) && !$flag) echo $_POST['$emp_fn']; ?>"/>
<p>Last Name: <input type="text" name="emp_ln" size="20" maxlength="30" value="<?php if (isset($_POST['$emp_ln']) && !$flag) echo $_POST['$emp_ln']; ?>"/>
<p>Title: 
<select name="title">
echo '<option value=""></option>';
  <option value="Chef"/>Chef</option>
  <option value="Waiter">Waiter</option>
  <option value="Bus Boy"/>Bus Boy</option>
  <option value="Driver">Driver</option>
  <option value="Laundry Employee"/>Laundry Employee</option>
  <option value="Inventory Manager">Inventory Manager</option>
  <option value="Florist"/>Florist</option>
</select>
<p>Address: <input type="text" name="address" size="20" maxlength="30" value="<?php if (isset($_POST['$address']) && !$flag) echo $_POST['$address']; ?>"/>

<div align="center"><input type="submit" name="submit" value="Create Account" /></div>
<a href="addaccountmenu.php">Return</a> <br>
</fieldset>
</form>
<p>

