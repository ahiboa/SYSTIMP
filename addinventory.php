<?php
session_start();
require_once('../mysql_connect.php');

$query="select category_name, category_no from category_ref";
$result=mysqli_query($dbc,$query);

if (isset($_POST['add'])){

$message=NULL;

 if (empty($_POST['name'])){
  $name=FALSE;
  $message.='<p>You forgot to enter the item name!';
 }else
  $name=$_POST['name'];

 if (empty($_POST['category'])){
  $category_id=FALSE;
  $message.='<p>You forgot to set the category!';
 }else
  $category_id=$_POST['category'];

 if (empty($_POST['quantity'])){
  $quantity=FALSE;
  $message.='<p>You forgot to enter the quantity!';
 }
else{
    $quantity=$_POST['quantity'];
    if(!isset($message)){
    require_once('../mysql_connect.php');
    $query2="select inventory_name from inventory where inventory_name ='{$name}'";
    $result2=mysqli_query($dbc,$query2);
    if ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
      if($category_id != 3){
         $message.="<b><p>{$name} already exists! Go to update inventory to add stock!";}
      }
    else{
          if(!mysqli_query($dbc,"insert into inventory (inventory_name, category, quantity) 
                  values ('{$name}','{$category_id}', '{$quantity}')")){
                     $message.='<p>Quantity invalid!';
                  }
          else{
              echo "Item added.";
          }
         }
    }
    }
  }

if (isset($message)){
 echo '<font color="red">'.$message. '</font>';
}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<fieldset><legend>Add New Item </legend>
<p>Item Name: <input type="text" name="name" size="15" maxlength="15" value="<?php if (isset($_POST['$name']) && !$flag) echo $_POST['$name']; ?>"/>
<p> Category List:
<select name = "category">
<option value=""></option>
    <?php
        while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $category_id=$row['category_no'];
            $category_name=$row['category_name'];
            echo '<option value ="'.$category_id.'">'. $category_name.'</option>';
        }
    ?>
</select>
<p>Quantity: <input type="text" name="quantity" size="5" maxlength="15" value="<?php if (isset($_POST['$quantity']) && !$flag) echo $_POST['$quantity']; ?>"/>
<div align="center"><input type="submit" name="add" value="Add to Inventory" /></div>
<a href="inventorymanagermenu.php">Return</a> <br>
</fieldset>
</form>
<p>

