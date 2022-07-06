<?php
require_once '../../../Business Services Layer/model/C_Model/CartModel.php';

class CartController{

  function calculateSubtotal($item_id, $quantity){
    $cart = new CartModel();
    $result = $cart->getItemPrice($item_id);
    foreach($result as $row)
      $price = $row['item_price'];
    return $price * $quantity;
  }

  function addCart(){

    $cart = new CartModel();
    $cart->item_id = $_POST['itemID'];//placeholder
    $cart->c_account_id = $_POST['cAccountID'];
    $cart->item_quantity = $_POST['quantity'];
    $cart->subtotal = $this->calculateSubtotal($_POST['itemID'], $_POST['quantity']);

    if($cart->addtoCart() > 0){
      $message = "Added to Cart";
      echo "<script type='text/javascript'>alert('$message');</script>";
    }
  }//end function

  function modifyQuantity(){
    $cart = new CartModel();
    $cart->item_id = $_POST['itemID'];
    $cart->quantity = $_POST['quantity'];
    $cart->subtotal = $this->calculateSubtotal($_POST['itemID'], $_POST['quantity']);
    
    if($cart->modifyCartQuantity()){
      $message = "Update Successful!";
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("Refresh:0");
    }
  }//end function

  function checkCart($item_id){
    $cart = new CartModel();
    $cart->c_account_id = $_SESSION['account_id'];

    return $cart->getItemID($item_id);
  }//end function
    
  function viewCart(){
    $cart = new CartModel();
    $cart->c_account_id = $_SESSION['account_id'];
    return $cart->viewAllCart();
  }//end function
  
  function removeItem(){
    $cart = new CartModel();
    $cart->item_id = $_POST['itemID'];
    $cart->c_account_id = $_SESSION['account_id'];
    $cart->deleteItem();
    header("Refresh:0");
  }//end function

  function calculateTotalPrice(){
    $total_price = 0;
    $cart = new CartModel();
    $cart->c_account_id = $_SESSION['account_id'];
    $result = $cart->getSubtotal();

    foreach($result as $row){
      $total_price += $row['subtotal'];
    }
    return $total_price;
  }

}
?>
