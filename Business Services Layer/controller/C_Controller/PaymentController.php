<?php
require_once '../../../Business Services Layer/model/C_Model/PaymentModel.php';

class PaymentController{

  function checkout(){
    $group = new PaymentModel();
    $pdo_result=$group->getGroup($_SESSION['account_id']);

    foreach ($pdo_result as $row) {
    $sp_account_id=$row['sp_account_id'];
    $payment = new PaymentModel();
    $payment->c_account_id = $_SESSION['account_id'];
// $payment->dropoff_location = $_POST['dropoff_location'];
    $payment->pay_method = "Paypal";
    //$payment->totalprice = $_POST['total']+10;

    $result = $payment->getItemID();
    foreach ($result as $row)
        $itemID = $row['item_id'];

    $payment->cust_id = $cust_id;

    $order_id = $payment->getLastOrder();
    $order_id++;
    $payment->order_id = $order_id;

    $payment->setOrder();
    }
    $message = "Please fill this COD Form";
    echo "<script type='text/javascript'>alert('$message');
    window.location = '../../view/C_View/C_placeorder.php';</script>";
  }



  function calculateSubtotal($item_id, $quantity){
    $cart = new CartModel();
    $result = $cart->getItemPrice($item_id);
    foreach($result as $row)
      $price = $row['item_price'];
    return $price * $quantity;
  }
  

}
?>
