<?php

class SP_MenuModel{

  public $item_id, $sp_account_id, $item_type,  $item_name, $item_detail, $item_price, $item_status, $delivery_id, $order_id, $payment_id, $r_account_id, $delivery_status;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function addNewItem(){

    $sql = "insert into `Item List` values (:item_id, :sp_account_id, :item_type, :item_name, :item_detail, :item_price, :item_status)";
    $args = [':item_id'=>$this->item_id, ':sp_account_id'=>$this->sp_account_id, ':item_type'=>$this->item_type, ':item_name'=>$this->item_name, ':item_detail'=>$this->item_detail, ':item_price'=>$this->item_price, ':item_status'=>$this->item_status];

    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();

  }

  function viewAllItem(){
    $sql = "select * from `Item List` where sp_account_id=:sp_account_id";
    $args = [':sp_account_id'=>$this->sp_account_id];
    
    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function viewAllOrder(){
    $account = ($this->sp_account_id);
    $sql = "select `Ordered Item`.order_id, `Ordered Item`.item_id, `Item List`.item_name, `Ordered Item`.quantity from `Ordered Item` inner join `Order List` on `Ordered Item`.order_id = `Order List`.order_id inner join `Item List` on `Ordered Item`.item_id = `Item List`.item_id where `Ordered Item`.item_id like '$account%'";
    $args = [':sp_account_id'=>$this->sp_account_id];

    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function viewSpecificItem(){
    $sql = "select * from `Item List` where item_id=:item_id";
    $args = [':item_id'=>$this->item_id];
    
    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function modifyItemInfo(){
    $sql = "update `Item List` set item_type=:item_type, item_name=:item_name, item_detail=:item_detail, item_price=:item_price, item_status=:item_status where item_id=:item_id";
    $args = [':item_type'=>$this->item_type, ':item_name'=>$this->item_name, ':item_detail'=>$this->item_detail, ':item_price'=>$this->item_price, ':item_status'=>$this->item_status, ':item_id'=>$this->item_id];

    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function deleteItem(){
    $sql = "delete from `Item List` where item_id=:item_id";
    $args = [':item_id'=>$this->item_id];

    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
  }

  function getLastItemID(){
    $sql = "select item_id from `Item List` where sp_account_id=:sp_account_id order by item_id desc limit 1";
    $args = [':sp_account_id'=>$this->sp_account_id];

    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    $count = $stmt->rowCount();

    if ($count > 0) {

      foreach ($stmt as $row)
        return $row['item_id'];

    } else {
      return $this->sp_account_id."AA00";
    }//end else 
  }

  function getLastDeliveryID(){
    $sql = "select delivery_id from `Delivery` order by delivery_id desc limit 1";
    $stmt = SP_MenuModel::connect()->prepare($sql);
    $count = $stmt->rowCount();

    if ($count > 0) {

      foreach ($stmt as $row)
        return $row['delivery_id'];
    } else {
      return "DA00";
    }//end else 
  }

  function generateDelivery(){
    $sql = "insert into `Delivery` values (:delivery_id, :order_id, :payment_id, :r_account_id, :delivery_status)";
    $args = [':delivery_id'=>$this->delivery_id, ':order_id'=>$this->order_id, ':payment_id'=>$this->payment_id, ':r_account_id'=>$this->r_account_id, ':delivery_status'=>$this->delivery_status];
    $stmt = SP_MenuModel::connect()->prepare($sql);
    $stmt->execute($args);
    $count = $stmt->rowCount();
    return $count;
  }
}
?>