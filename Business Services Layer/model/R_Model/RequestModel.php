<?php

class RequestModel{

  public $order_id, $r_account_id;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getDeliveryOrderID($id){ //get order ID for current delivery
    $sql = "SELECT `Order List`.order_id, `Order List`.sp_account_id, `Order List`.status FROM `Delivery` inner join `Order List` on Delivery.order_id=`Order List`.`order_id` WHERE Delivery.r_account_id='$id'";
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function modifyStatus($order_id, $update){ //update delivery status to drop off/complete
    $date=date("d/m/Y");
    $sql = "update `Order List` inner join Delivery on `Order List`.order_id=Delivery.order_id set `Order List`.status='$update', Delivery.date='$date' where Delivery.order_id='$order_id'";
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt->rowcount();
  }

  function checkExistingDelivery($id){ //check if runner have already taken a request or not
    $sql = "SELECT Delivery.r_account_id FROM `Delivery` inner join `Order List` on Delivery.order_id=`Order List`.`order_id` WHERE `Order List`.`status`!='Requesting' and `Order List`.`status`!='Completed' and Delivery.r_account_id='$id'";
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt->rowcount();
  }

  function getAllRequest(){ //get all request info made by customer
    $sql = "select `Order List`.*, `Service Provider`.address, `Account`.name from `Order List` inner join `Service Provider` on `Order List`.sp_account_id = `Service Provider`.account_id inner join `Account` on `Order List`.sp_account_id = `Account`.account_id where `Order List`.status='Requesting'";
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getOrderInfo($order_id){ //get request info for one specific order
    $sql = "select `Order List`.*, `Service Provider`.address, `Account`.name from `Order List` inner join `Service Provider` on `Order List`.sp_account_id = `Service Provider`.account_id inner join `Account` on `Order List`.sp_account_id = `Account`.account_id where order_id='$order_id'";
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getOrderedItem($order_id, $spID){ //get the items ordered in one specific order
    $sql = "select `Item List`.item_name, `Ordered Item`.quantity from `Item List` inner join `Ordered Item` on `Item List`.item_id = `Ordered Item`.item_id and `Ordered Item`.item_id like '%$spID%'";
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function setDelivery(){ //update order list and delivery with staus and responsible runner
    $date=date("d/m/Y");
    $sql = "insert into Delivery values(:order_id, :r_account_id, '$date')";
    $args = [':order_id'=>$this->order_id, ':r_account_id'=>$this->r_account_id];
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute($args);

    $sql = "update `Order List` set status='Pick Up' where order_id=:order_id";
    $args = [':order_id'=>$this->order_id];
    $stmt = RequestModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowcount();
  }
}
?>