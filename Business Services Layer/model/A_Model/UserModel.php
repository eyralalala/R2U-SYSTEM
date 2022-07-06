<?php

class UserModel{

  public $account_id;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function countTotalUser(){
    $sql="SELECT sum(case when account_type='Runner' and status='Active'then 1 else 0 end) as a, sum(case when account_type='Service Provider' and status='Active' then 1 else 0 end) as b, sum(case when account_type='Runner' and status='Pending' then 1 else 0 end) as c, sum(case when account_type='Service Provider' and status='Pending' then 1 else 0 end) as d FROM Account ";

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function countRow($type, $people){
    if($people=="apply")
      $sql="select * from Account where account_type='$type' and status='pending'";
    else $sql="select * from Account where account_type='$type' and status='Active'";

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt->rowcount();
  }

  function countSearchedRow($type, $result){
    $sql="select * from Account where account_type='$type' and status='Active' and name like '%".$result."%'";

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt->rowcount();
  }

  function getAllApplication($type, $offset, $rowlimit){
    $sql="select * from Account where account_type='$type' and status='pending' limit $offset, $rowlimit";

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getApplication($id, $type){
      $sql="select * from Account inner join `$type` on Account.account_id=`$type`.account_id where Account.account_id='$id'";

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function setStatus($status){
  	$sql="update Account set status='$status' where account_id=:account_id";
  	$args=[':account_id'=>$this->account_id];

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

  function getAllUser($type, $result, $offset, $rowlimit){
    if($result==NULL)
      $sql="select * from Account where account_type='$type' and status='Active' limit $offset, $rowlimit";
    else $sql="select * from Account where account_type='$type' and status='Active' and name like '%".$result."%' limit $offset, $rowlimit";

    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt;
  }

  function getItemCount($id){
    $sql="select * from `Item List` where sp_account_id='$id'";
    $stmt = UserModel::connect()->prepare($sql);
    $stmt->execute();
    return $stmt->rowcount();
  }
}
?>