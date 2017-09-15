<?php
session_start();
require_once('../mysql_connect.php');

$confirmedid = $_SESSION['event_select'];
$confirmeditem = $_SESSION['items'];
echo $confirmedid;
echo $confirmeditem;
if (isset($_POST['lost'])){

$message=NULL;

 if (empty($_POST['quantity'])){
  $quantity=FALSE;
  $message.='<p>You forgot to enter the quantity!';
 }
else{
    $quantity=$_POST['quantity'];
    if(!isset($message)){
    require_once('../mysql_connect.php');
          $flag=1;
          if(!mysqli_query($dbc,"insert into lost_inventory (inventory_id,lostquantity) 
                  values ('{$confirmeditem}', '{$quantity}')")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              $query2 = "update event_deployment
                         set quantity = quantity - '{$quantity}'
                         where inventory_deployed = '{$confirmeditem}'";
              $result2=mysqli_query($dbc,$query2);
              echo "Report has been recorded.";
          }
         }
    }
  }

if (isset($_POST['damaged'])){

$message=NULL;

 if (empty($_POST['quantity'])){
  $quantity=FALSE;
  $message.='<p>You forgot to enter the quantity!';
 }
else{
    $quantity=$_POST['quantity'];
    if(!isset($message)){
    require_once('../mysql_connect.php');
          $flag=1;
          if(!mysqli_query($dbc,"insert into damaged_inventory (inventory_id,damagedquantity) 
                  values ('{$confirmeditem}', '{$quantity}')")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              $query2 = "update event_deployment
                         set quantity = quantity - '{$quantity}'
                         where inventory_deployed = '{$confirmeditem}'";
              $result2=mysqli_query($dbc,$query2);
              echo "Report has been recorded.";
          }
         }
    }
  }

if (isset($_POST['finish'])){
   header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/itemreturnlist.php");
  }


if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Record Lost/Damaged Inventory </legend>
<p>Quantity: <input type="text" name="quantity" size="5" maxlength="15" value="<?php if (isset($_POST['$quantity']) && !$flag) echo $_POST['$quantity']; ?>"/>
<div align="center">Record As: <input type="submit" name="lost" value="Lost" />
<input type="submit" name="damaged" value="Damaged" /><input type="submit" name="finish" value="Finished" /></div> <br>
</fieldset>
</form>
<p>

