<?php
session_start();
require_once('../mysql_connect.php');

$query="select distinct(e.event_name), e.event_id from event_deployment ed join event e on e.event_id=ed.event_deployed
        where e.event_date_time < now() and ed.status = 'Deployed'";
$result=mysqli_query($dbc,$query);

if (isset($_POST['complete'])){
    if(empty($_POST['event_select'])){
        echo "Please select a client";
    }
   else{
    $_SESSION['event_select']=$_POST['event_select'];
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/itemreturnlist.php");
}
}



if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Inventory Returns </legend>

<p> Event List:
<select name = "event_select">
<option value=""></option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $event_id=$row['event_id'];
            $event_name=$row['event_name'];
            echo '<option value ="'.$event_id.'">'. $event_name.'</option>';
        }
    ?>
</select>
<div align="center">
<input type="submit" name="complete" value="Proceed" /></div>
<a href="inventorymanagermenu.php">Return</a> <br>
</fieldset>
</form>
<p>

