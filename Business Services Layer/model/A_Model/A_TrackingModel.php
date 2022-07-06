<?php

class A_TrackingModel{

  public $order_id, $r_account_id;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getAllReport(){ //get order ID for current delivery
    $sql = "SELECT * FROM `Delivery` inner join `Order List` on Delivery.order_id=`Order List`.`order_id` inner join `Account` on `Account`.account_id=`Order List`.`sp_account_id` inner join `Service Provider` on `Service Provider`.account_id=`Order List`.sp_account_id where `Order List`.status='Completed'";
    $stmt = A_TrackingModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getRunnerName($id){ //get order ID for current delivery
    $sql = "SELECT name FROM `Account` where account_id='$id'";
    $stmt = A_TrackingModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

}
?>