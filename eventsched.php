<?php
session_start();
require_once('../mysql_connect.php');
$sessionid = $_SESSION['account_id'];
if (isset($_POST['submit'])){

$message=NULL;

 if (empty($_POST['venue'])){
  $venue=FALSE;
  $message.='<p>You forgot to enter the venue!';
 }else
  $venue=$_POST['venue'];

 if (empty($_POST['event_date_time'])){
  $event_date_time=NULL;
  $message.='<p>You forgot to set the date!';
 }else{
  $event_date_time=$_POST['event_date_time'];
 }
if (empty($_POST['theme'])){
  $theme=NULL;
  $message.='<p>You forgot to set the theme!';
 }else
  $theme=$_POST['theme'];

 if (empty($_POST['centerpiece'])){
  $centerpiece=NULL;
  $message.='<p>You forgot to select the centerpiece!';
 }else
  $centerpiece=$_POST['centerpiece'];

 if (empty($_POST['flowers'])){
  $flowers=NULL;
  $message.='<p>You forgot to select flowers!';
 }else
  $flowers=$_POST['flowers'];

 if (empty($_POST['linen'])){
  $linen=NULL;
  $message.='<p>You forgot to select linen color!';
 }else
  $linen=$_POST['linen'];

if (empty($_POST['others'])){
  $others="";
 }else
  $others=$_POST['others'];
 
 if (empty($_POST['totalpax'])){
  $totalpax=NULL;
  $message.='<p>You forgot to enter the number of people!';
 }else
  $totalpax=$_POST['totalpax'];

if (empty($_POST['eventtype'])){
  $eventtype=FALSE;
  $message.='<p>You forgot to set the event type!';
 }else
  $eventtype=$_POST['eventtype'];

 if (empty($_POST['package_id'])){
  $package_id=NULL;
 }else
  $package_id=$_POST['package_id'];

 if (empty($_POST['event_name'])){
  $event_name=NULL;
 }else
  $event_name=$_POST['event_name'];

 if (empty($_POST['priceperhead'])){
  $priceperhead=NULL;
 }else
  $priceperhead=$_POST['priceperhead'];


if(!isset($message)){
$flag=1;
if(!mysqli_query($dbc, "insert into event (venue, event_date_time, theme, centerpiece, flowers, linencolor,
                 others, totalpax, event_type, package_id, event_name, client_id, status) 
        values ('{$venue}', '{$event_date_time}', '{$theme}', '{$centerpiece}', '{$flowers}', '{$linen}', '{$others}', 
                '{$totalpax}', '{$eventtype}', '{$package_id}', '{$event_name}', '{$sessionid}', 'Pending')")){
                    echo("Wrong input, please check data.");
                }
}
}
$query="select i.inventory_name from inventory i join category_ref c 
        on i.category=c.category_no where c.category_no = 1";
$result=mysqli_query($dbc,$query);

$query2="select i.inventory_name from inventory i join category_ref c 
        on i.category=c.category_no where c.category_no = 2";
$result2=mysqli_query($dbc,$query2); 

$query3="select package_id, package_name from package";
$result3=mysqli_query($dbc,$query3); 


if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Event Details: </legend>
<p>Event Name: <input type="text" name="event_name" size="20" maxlength="30" value="<?php if (isset($_POST['$event_name']) && !$flag) echo $_POST['$event_name']; ?>"/>
<p>Venue: <input type="text" name="venue" size="20" maxlength="30" value="<?php if (isset($_POST['$venue']) && !$flag) echo $_POST['$venue']; ?>"/>
<p>Date (YYYY-MM-DD HH:MM:SS): <input type="text" name="event_date_time" size="20" maxlength="30" value="<?php if (isset($_POST['$event_date_time']) && !$flag) echo $_POST['$event_date_time']; ?>"/>
<p>Theme: <input type="text" name="theme" size="20" maxlength="30" value="<?php if (isset($_POST['$theme']) && !$flag) echo $_POST['$theme']; ?>"/>
<p>Total Head Count: <input type="text" name="totalpax" size="20" maxlength="30" value="<?php if (isset($_POST['$totalpax']) && !$flag) echo $_POST['$totalpax']; ?>"/>
<p>Event Type: <input type="text" name="eventtype" size="20" maxlength="30" value="<?php if (isset($_POST['$eventtype']) && !$flag) echo $_POST['$eventtype']; ?>"/>
</fieldset>
<fieldset><legend>Orders: </legend>
<p> Centerpiece:
<select name = "centerpiece">
echo '<option value=""></option>';
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $center=$row['inventory_name'];
            echo '<option value ="'.$center.'">'.$center.'</option>';
        }
    ?>
</select>
<p> Flowers:
<select name = "flowers">
echo '<option value=""></option>';
    <?php
        while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $flower=$row2['inventory_name'];
            echo '<option value ="'.$flower.'">'.$flower.'</option>';
        }
    ?>
</select>
<p> Linen Color:
<select name="linen">
echo '<option value=""></option>';
  <option value="Red"/>Red</option>
  <option value="Purple">Purple</option>
  <option value="White"/>White</option>
  <option value="Gold">Gold</option>
  <option value="Black"/>Black</option>
</select>
<p>Others: <input type="text" name="others" size="20" maxlength="30" value="<?php if (isset($_POST['$others']) && !$flag) echo $_POST['$others']; ?>"/>
<p> Meal Package:
<select name = "package_id">
echo '<option value=""></option>';
    <?php
        while($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)){
            $packid=$row3['package_id'];
            $packname=$row3['package_name'];
            echo '<option value ="'.$packid.'">'.$packname.'</option>';
        }
    ?>
</select>
</fieldset> <br>
<div align="center"><input type="submit" name="submit" value="Reserve Event" /></div> <br>
<a href="customermenu.php">Return</a> <br>
</form>
<p>

