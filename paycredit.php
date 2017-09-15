<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
$sessionid = $_SESSION['account_id'];
if (isset($_POST['submit'])){
if (empty($_POST['event_select'])){
   $event_id=FALSE;  
}

else{
    $_SESSION['event_select']=$_POST['event_select'];
    $confirmedid = $_SESSION['event_select'];
    $event_id=$_POST['event_select'];
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/confirmpayment.php");
}

}

$query="select e.event_id, e.event_name, e.event_date_time, c.client_name from
               event e join client_ref c on e.client_id=c.client_id join payment p 
               on e.event_id=p.payment_event_id where 
               e.event_date_time > date(now()) and e.client_id = '{$sessionid}' and p.status = 'Unpaid' and e.status = 'Approved'";
$result=mysqli_query($dbc,$query);

?>
<form action="" method="post">

<p> Banking Method:
<input type="radio" name="banking" value="BDO"> BPI
<input type="radio" name="banking" value="BPI"> BDO
<input type="radio" name="banking" value="Paypal"> Paypal

<p> Reserved Events:
<select name = "event_select">
<option selected = "selected">---Event Name---</option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $event_id=$row['event_id'];
            $event_name=$row['event_name'];
            $date=$row['event_date_time'];
            $client_name=$row['client_name'];
            echo '<option value ="'.$event_id.'">'.$event_name." ".$date." ".$client_name.'</option>';
        }
    ?>
</select>

<div align="center"><input type="submit" name="submit" value="Proceed to payment" /></div>
<a href="customermenu.php">Return</a>

    
   