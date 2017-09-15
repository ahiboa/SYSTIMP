<?php
session_start();
require_once('../mysql_connect.php');
$confirmedid = $_SESSION['event_select'];
echo $confirmedid;
$query="select i.inventory_name, ed.inventory_deployed from event_deployment ed join inventory i on i.inventory_id=ed.inventory_deployed 
        where ed.event_deployed = '{$confirmedid}' and ed.status != 'Returned' and ed.quantity > 0";
$result=mysqli_query($dbc,$query);



if (isset($_POST['return'])){
   if(empty($_POST['items'])){
        echo "Please select the item to return";
    }
   else{
    $items = $_POST['items'];
    echo $items;
    if(!mysqli_query($dbc,"insert into inventory_returned (event_returned, returned_id)
            values('{$confirmedid}', '{$items}')")){
             echo("Wrong input, please check data.");
            }
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/itemreturnlist.php");
    }

}

if (isset($_POST['record'])){
    $_SESSION['items']=$_POST['items'];
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/returnlostdamage.php");
}


if (isset($_POST['complete'])){
    header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/returninventory.php");
}


?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset> <legend> Item List </legend>
<p> Items rented:
<select name = "items">
<option value=""></option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $inventory_name=$row['inventory_name'];
            $inventory_id=$row['inventory_deployed'];
            echo '<option value ="'.$inventory_id.'">'.$inventory_name.'</option>';
        }
    ?>
    
</select> <div align="center">
 <input type="submit" name="return" value="Record Return" /> 
 <input type="submit" name="record" value="Record Lost/Damage" />
 <input type="submit" name="complete" value="Finish Recording" /> <br>
</fieldset>