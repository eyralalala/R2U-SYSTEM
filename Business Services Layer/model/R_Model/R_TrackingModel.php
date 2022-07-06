<?php

class R_TrackingModel{

  public $order_id, $r_account_id;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getAllReport($id){ //get order ID for current delivery
    $sql = "SELECT * FROM `Delivery` inner join `Order List` on Delivery.order_id=`Order List`.`order_id` inner join `Account` on `Account`.account_id=`Order List`.`sp_account_id` inner join `Service Provider` on `Service Provider`.account_id=`Order List`.sp_account_id where `Delivery`.r_account_id='$id'";
    $stmt = R_TrackingModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }
}
?>