<?php
session_start();
require_once('../mysql_connect.php');

$query="select inventory_id, inventory_name, category from inventory where category <> '3'";
$result=mysqli_query($dbc,$query);

if (isset($_POST['update'])){

$message=NULL;

 if (empty($_POST['itemlist'])){
  $item_id=FALSE;
  $message.='<p>You forgot to select the item!';
 }else
  $item_id=$_POST['itemlist'];

 if (empty($_POST['quantity'])){
  $quantity=FALSE;
  $message.='<p>You forgot to enter the quantity!';
 }
else{
    $quantity=$_POST['quantity'];
    if(!isset($message)){
    require_once('../mysql_connect.php');
          $flag=1;
          if(!mysqli_query($dbc,"update inventory
                                 set quantity = quantity + '{$quantity}'
                                 where inventory_id = '{$item_id}'")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              echo "Inventory updated.";
          }
         }
    }
  }

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Update Inventory </legend>
<p> Item List:
<select name = "itemlist">
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
<div align="center"><input type="submit" name="update" value="Update Inventory" /></div>
<a href="inventorymanagermenu.php">Return</a> <br>
</fieldset>
</form>
<p>

