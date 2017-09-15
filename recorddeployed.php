<?php
session_start();
require_once('../mysql_connect.php');
$confirmedid = $_SESSION['event_select'];
$confirmedcat = $_SESSION['category_select'];
$query="select inventory_id, inventory_name, category from inventory where category = '{$confirmedcat}' and quantity > 0";
$result=mysqli_query($dbc,$query);

if (isset($_POST['record'])){

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
          $flag=1;
          if(!mysqli_query($dbc,"insert into event_deployment (event_deployed, inventory_deployed, quantity) 
                  values ('{$confirmedid}', '{$inventory_id}', '{$quantity}')")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              $query2 = "update inventory
                         set quantity = quantity - {$quantity}
                         where inventory_id = {$inventory_id}";
              $result2=mysqli_query($dbc,$query2);
              header("Location: http://".$_SERVER['HTTP_HOST'].  dirname($_SERVER['PHP_SELF'])."/deploymententries.php");
          }
         }
    }
  }

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Record Item to Deploy </legend>

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
<div align="center"><input type="submit" name="record" value="Record" />
</fieldset>
</form>
<p>

