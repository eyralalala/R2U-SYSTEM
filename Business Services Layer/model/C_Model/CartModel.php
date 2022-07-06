<?php
require_once '../../../libs/database.php';

class CartModel{

public $c_account_id, $item_id, $item_quantity, $subtotal;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getItemPrice($item_id){

    $sql = "select item_price from `Item List` where item_id='$item_id'";

    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function addtoCart(){

    $sql = "insert into `Cart` values (:c_account_id, :item_id, :item_quantity, :subtotal)";
    $args = [':c_account_id'=>$this->c_account_id, ':item_id'=>$this->item_id, ':item_quantity'=>$this->item_quantity, ':subtotal'=>$this->subtotal];

    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();

  }

  function modifyCartQuantity(){
    $sql = "update Cart set quantity=:quantity, subtotal=:subtotal where item_id=:item_id";
    $args = [':quantity'=>$this->quantity, ':subtotal'=>$this->subtotal, ':item_id'=>$this->item_id];
    
    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function getItemID($item_id){
    $sql = "select quantity from Cart where c_account_id = :c_account_id and item_id='$item_id'";
    $args = [':c_account_id'=>$this->c_account_id];
    
    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute($args);
    $count = $stmt->rowCount();

    if ($count > 0) {
      foreach ($stmt as $row)
        return $row['quantity'];
    } else return "0";

  }
  
  function viewAllCart(){
    $sql = "select Cart.*, `Item List`.item_name, `Item List`.item_price from Cart inner join `Item List` on Cart.item_id=`Item List`.item_id where Cart.c_account_id=:c_account_id";
    $args = [':c_account_id'=>$this->c_account_id];

    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function deleteItem(){
    $sql = "delete from `Cart` where item_id=:item_id and c_account_id = :c_account_id";
    $args = [':item_id'=>$this->item_id, ':c_account_id'=>$this->c_account_id];

    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute($args);
  }

  function getSubtotal(){
    $sql = "select subtotal from `Cart` where c_account_id = :c_account_id";
    $args = [':c_account_id'=>$this->c_account_id];
    
    $stmt = CartModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

}
?>