<?php

class C_ItemModel{

public $item_id;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function getTypeList($type){
    $sql = "select * from `Item List` where item_type='$type' order by item_name asc";

    $stmt = C_ItemModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }
    function getAllList(){
    $sql = "select * from `Item List` order by item_name asc";

    $stmt = C_ItemModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getSP_name($sp){
    $sql = "select name from Account where account_id='$sp'";
    
    $stmt = C_ItemModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getAllItem($type, $sp){
    $sql = "select * from `Item List` where item_type='$type' and sp_account_id='$sp' order by item_name asc";
    
    $stmt = C_ItemModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function viewSpecificItem(){
    $sql = "select * from `Item List` where item_id=:item_id";
    $args = [':item_id'=>$this->item_id];
    
    $stmt = C_ItemModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }
}
?>