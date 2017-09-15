<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');

$query="select e.event_id, e.event_name, e.event_date_time, c.client_name from
               event e join client_ref c on e.client_id=c.client_id where e.status = 'Reserved' 
               and e.event_date_time > now()";
$result=mysqli_query($dbc,$query);

?>
<form action="" method="post">

<fieldset>
<p> Events:
<select name = "event_select">
echo '<option value=""></option>';
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $event_id=$row['event_id'];
            $event_name=$row['event_name'];
            $date=$row['event_date_time'];
            $client_name=$row['client_name'];
            echo '<option value ="'.$event_id.'">'.$event_name."-".$date."-".$client_name.'</option>';
        }
    ?>
</select> <input type="submit" name="view" value="Select" /> <a href="inventorymanagermenu.php">Return</a><br><br>
</fieldset>


<?php
if (isset($_POST['view'])){
if (empty($_POST['event_select'])){
   echo "No client selected";  
}
else{
$_SESSION['event_select']=$_POST['event_select'];
header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/deploymententries.php");
}
}
?>