<?php
session_start();
require_once('../mysql_connect.php');

$query="select inventory_id, inventory_name, category from inventory where category <> '3'";
$result=mysqli_query($dbc,$query);

if (isset($_POST['lost'])){

$message=NULL;

 if (empty($_POST['item_list'])){
  $inventory_id=FALSE;
  $message.='<p>You forgot to enter the item!';
 }else
  $inventory_id=$_POST['item_list'];

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
                  values ('{$inventory_id}', '{$quantity}')")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              echo "Report has been recorded.";
          }
         }
    }
  }

if (isset($_POST['damaged'])){

$message=NULL;

 if (empty($_POST['item_list'])){
  $inventory_id=FALSE;
  $message.='<p>You forgot to enter the item!';
 }else
  $inventory_id=$_POST['item_list'];

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
                  values ('{$inventory_id}', '{$quantity}')")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              echo "Report has been recorded.";
          }
         }
    }
  }

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Record Lost/Damaged Inventory </legend>

<p> Item List:
<select name = "item_list">
<option value=""></option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $inventory_id=$row['inventory_id'];
            $inventory_name=$row['inventory_name'];
            echo '<option value ="'.$inventory_id.'">'. $inventory_name.'</option>';
        }
    ?>
</select>
<p>Quantity: <input type="text" name="quantity" size="5" maxlength="15" value="<?php if (isset($_POST['$quantity']) && !$flag) echo $_POST['$quantity']; ?>"/>
<div align="center">Record As: <input type="submit" name="lost" value="Lost" />
<input type="submit" name="damaged" value="Damaged" /></div>
<a href="inventorymanagermenu.php">Return</a> <br>
</fieldset>
</form>
<p>

