<?php
require_once '../../../Business Services Layer/model/R_Model/RequestModel.php';

class RequestController{

  function checkDelivery($id){ //check if runner have already taken a request or not
    $runner = new RequestModel();
    if($runner->checkExistingDelivery($id)>0)
      return true;
    else return false;
  }

  function getOrderID($id){ //get order ID for current delivery

    $runner = new RequestModel();
    return $runner->getDeliveryOrderID($id);
  }

  function updateStatus($order_id, $status){ //update delivery status to drop off/complete
    $runner = new RequestModel();
    if($status=="Pick Up"){
      $update="Drop Off";
    }else $update="Completed";
    if($runner->modifyStatus($order_id, $update)>0){
      $message = "Delivery Updated";
      echo "<script type='text/javascript'>alert('$message');</script>";
      header("Refresh:0");
    }
  }
    
  function viewRequestList(){ //get all request info made by customer

    $runner = new RequestModel();
    return $runner->getAllRequest();
  }

  function orderInfo($order_id){ //get request info for one specific order
    $runner = new RequestModel();
    return $runner->getOrderInfo($order_id);
  }

  function orderedItem($order_id, $spID){ //get the items ordered in one specific order
    $runner = new RequestModel();
    return $runner->getOrderedItem($order_id, $spID);
  }

  
  function confirmDelivery(){ //Process for when runner accept the request
    $runner = new RequestModel();
    $runner->order_id = $_POST['order_id'];
    $runner->r_account_id = $_SESSION['account_id'];
    if($runner->setDelivery()>0){
      $message = "Request Accepted";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../view/R_View/Delivery.php';</script>";
    }
  }
}
?>
