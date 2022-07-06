<?php
require_once '../../../libs/database.php';

class PaymentModel{

public $order_id, $c_account_id, $sp_account_id, $pay_method, $dropoff_location, $totalprice;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getGroup($id){ //connect to database
    $sql = "select `Item List`.sp_account_id from Cart inner join `Item List` on `Item List`.item_id=`Cart`.item_id where Cart.c_account_id='$id' GROUP by `Item List`.sp_account_id";

    $stmt = PaymentModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getLastOrder(){
    $sql = "select order_id from `Order List` order by order_id desc limit 1";
    
    $stmt = PaymentModel::connect()->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {

      foreach ($stmt as $row)
        return $row['order_id'];

    } else return "AA00AA00AA00";
  }

  function getItemID(){
    $sql = "select item_id from `Cart` limit 1";
    $stmt = PaymentModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function setOrder(){
    $sql = "insert into `Order List` values (:order_id, :c_account_id, :pay_method, :sp_account_id, :dropoff_location, :totalprice, 'Requesting')";
    $args = [':order_id'=>$this->order_id, ':c_account_id'=>$this->c_account_id, ':pay_method'=>$this->pay_method, ':sp_account_id'=>$this->sp_account_id, ':dropoff_location'=>$this->dropoff_location, ':totalprice'=>$this->totalprice];

    $stmt = PaymentModel::connect()->prepare($sql);
    //$stmt->execute($args);

    $sql = "insert into `Ordered Item` select `Order List`.order_id, Cart.item_id, Cart.quantity from `Order List`, Cart where `Order List`.c_account_id = :c_account_id and `Cart`.c_account_id = :c_account_id and `Order List`.order_id=:order_id and Cart.item_id like '%".$this->sp_account_id."%'";
    $args = [':c_account_id'=>$this->c_account_id, ':order_id'=>$this->order_id];

    $stmt = PaymentModel::connect()->prepare($sql);
    $stmt->execute($args);

    $sql = "delete from Cart where c_account_id = :c_account_id and item_id like '%".$this->sp_account_id."%'";
    $args = [':c_account_id'=>$this->c_account_id];
    
    $stmt = PaymentModel::connect()->prepare($sql);
    $stmt->execute($args);
  }
}
?>