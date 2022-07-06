<?php

class C_TrackingModel{

  public $order_id;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getAllReport($id){ //get ALL Report
    $sql = "SELECT * FROM `Delivery` inner join `Order List` on Delivery.order_id=`Order List`.`order_id` inner join `Account` on `Account`.account_id=`Order List`.`sp_account_id` where `Order List`.c_account_id='$id' and `Order List`.status='Completed'";
    $stmt = C_TrackingModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getDeliveryStatus($id){ //get status current delivery
    $sql = "SELECT * FROM `Order List` where c_account_id='$id' and status!='Completed'";
    $stmt = C_TrackingModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }
}
?>