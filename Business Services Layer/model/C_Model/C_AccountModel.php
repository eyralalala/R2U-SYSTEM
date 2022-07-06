<?php

class C_AccountModel{

  public $account_id, $name, $contact_no, $email, $password, $status;

  function connect(){ 
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function checkEmail(){
    $sql = "select * from Account where email = :email";
    $args = [':email'=>$this->email];

    $stmt = C_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getLastC_ID(){
    $sql = "select account_id from Account where account_type = 'Customer' order by account_id desc limit 1";
    
    $stmt = C_AccountModel::connect()->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {

      foreach ($stmt as $row)
        return $row['account_id'];

    } else return "AAAA0000";
  }

  function C_addNewAccount(){
    $sql = "insert into Account values (:account_id, 'Customer', :name, :contact_no, :email, :password, :status)";
    $args = [':account_id'=>$this->account_id, ':name'=>$this->name, ':contact_no'=>$this->contact_no, ':email'=>$this->email, ':password'=>$this->password, ':status'=>$this->status];
   
    $stmt = C_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }
  
  function checkC_Acc(){
    $sql = "select * from Account where account_type = 'Customer' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];

    $stmt = C_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getC_ID(){
    $sql = "select account_id, name from Account where account_type = 'Customer' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];

    $stmt = C_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

}
?>