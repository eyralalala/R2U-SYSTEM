<?php


class A_AccountModel{

  public $account_id, $account_type, $name, $contact_no, $email, $password, $status;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  //functions for admin login
  function checkA_Acc(){
    $sql = "select * from Account where account_type = 'Admin' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];

    $stmt = A_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getA_ID(){
    $sql = "select account_id from Account where account_type = 'Admin' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];

    $stmt = A_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }
  //end admin login functions

  //functions for adding new admin accounts
  function checkEmail(){
    $sql = "select * from Account where email = :email";
    $args = [':email'=>$this->email];

    $stmt = A_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getLastA_ID(){
    $sql = "select account_id from Account where account_type = :account_type order by account_id desc limit 1";
    $args = [':account_type'=>$this->account_type];

    $stmt = A_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);

    foreach($stmt as $row)
      return $row['account_id'];
  }

  function A_addNewAccount(){
    $sql = "insert into Account values (:account_id, :account_type, :name, :contact_no, :email, :password, :status)";
    $args = [':account_id'=>$this->account_id, ':account_type'=>$this->account_type, ':name'=>$this->name, ':contact_no'=>$this->contact_no, ':email'=>$this->email, ':password'=>$this->password, ':status'=>$this->status];

    $stmt = A_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }
  //end add new admin functions
}
?>