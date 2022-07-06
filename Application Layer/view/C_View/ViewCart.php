<?php
require_once '../../../Business Services Layer/controller/C_Controller/CartController.php';

$cart = new CartController();

$data = $cart->viewCart();

if(isset($_POST['remove_btn'])){
  $cart->removeItem();
}

if(isset($_POST['update_btn'])){
  $cart->modifyQuantity();
}

?>

<html>
  <head>
    <title>Cart</title>
    <style>
      table, td, tr{
        border: 1px solid black;
      }
      th, td{
        padding:8px;
      }
    </style>
  </head>
  <body>
    <center><br>

        <input type="hidden" name="cAccountID" value="<?=$cAccountID?>">
        <table>

          <h2>Cart</h2>

          <tr>
            <td>Item Name</td>
            <td>Price per Unit (RM)</td>
            <td>Item Quantity</td>
            <td>Price (RM)</td>
            <td>Action</td>
          </tr>

          <?php
          $i = 0;
          foreach($data as $row){
            $i++;
          ?>

          <tr>
            <td><?=$row['item_name']?></td>

            <td><?=$row['item_price']?></td>

            <form action="" method="POST">

              <td><input type ="number" min="0" name="quantity" value="<?=$row['quantity']?>"></td>


              <td><?=$row['subtotal']?></td>
              <input type="hidden" name="itemID" value="<?=$row['item_id']?>">

              <td>
                <input type="submit" name="update_btn" value="Update Quantity">

                <input type="submit" name="remove_btn" value="Remove">
              </td>

            </form>
          </tr>

          <?php
          }
          if($i==0)
            $btn_status = "disabled";
          else $btn_status = "NULL";
          ?>

          <tr>
            <td colspan="4" style="text-align: right">Total Price</td>
            <td><?php echo $cart->calculateTotalPrice()?></td>
          </tr>

          <tr>
            <td colspan="5" style="text-align: center">
              <button onclick="window.location.href='C_Home.php'">Home</button>
              <button onclick="window.location.href='cod.php'" <?=$btn_status?>>Checkout</button>
            </td>

          </tr>

        </table>

       

    </center>
  </body>
</html>
