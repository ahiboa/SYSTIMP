<html>
<body>

<?php
session_start();
require_once('../mysql_connect.php');
if (isset($_POST['submit'])){

if (empty($_POST['employee_select'])){
   $emp_id=FALSE;  
   echo "No employee selected <br>";
}

else{
    $emp_id=$_POST['employee_select'];
}


if (empty($_POST['event_select'])){
   $event_id=FALSE;  
   echo "No event selected";
}

else{
    $event_id=$_POST['event_select'];
}


$query="insert into employee_event_schedule (employee_event_id, employee_id) 
        values ('{$event_id}','{$emp_id}')";

$result=mysqli_query($dbc,$query);



}
$query="select e.event_id, e.event_name, e.event_date_time, c.client_name from
               event e join client_ref c on e.client_id=c.client_id where 
               e.event_date_time > date(now()) and e.status = 'Reserved'";
$result=mysqli_query($dbc,$query);

$query2="select emp_id, emp_ln, emp_fn from employee where title <> 'Inventory Manager' ";
$result2=mysqli_query($dbc,$query2);

?>
<form action="" method="post">
<p> Employee List:
<select name = "employee_select">
<option value=""></option>
    <?php
        while($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
            $last_name=$row2['emp_ln'];
            $first_name=$row2['emp_fn'];
            $emp_id=$row2['emp_id'];
            echo '<option value ="'.$emp_id.'">'.$last_name.", ".$first_name." ".'</option>';
        }
    ?>
</select>
<br> <br>
<p> Event List:
<select name = "event_select">
<option value=""></option>
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

<div align="center"><input type="submit" name="submit" value="Assign Employee" /></div>
<a href="menu.php">Return</a>

    
   