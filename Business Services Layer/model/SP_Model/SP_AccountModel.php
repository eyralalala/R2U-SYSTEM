<?php

class SP_AccountModel{

  public $account_id, $name, $contact_no, $email, $password, $status, $logo;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function checkEmail(){ //get email which are same with the input email from the database
    $sql = "select * from Account where email = :email";
    $args = [':email'=>$this->email];

    $stmt = SP_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getLastSP_ID(){ //get the most recent Runner ID from the database
    $sql = "select account_id from Account where account_type = 'Service Provider' order by account_id desc limit 1";
    
    $stmt = SP_AccountModel::connect()->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {

      foreach ($stmt as $row)
        return $row['account_id'];

    } else return "A0000000";
  }

  function SP_addNewAccount(){ //Adding service provider registered info into database
    $sql = "insert into Account values (:account_id, 'Service Provider', :name, :contact_no, :email, :password, :status)";
    $args = [':account_id'=>$this->account_id, ':name'=>$this->name, ':contact_no'=>$this->contact_no, ':email'=>$this->email, ':password'=>$this->password, ':status'=>$this->status];

    $stmt = SP_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);

    $sql = "insert into `Service Provider` values (:account_id, :ssmNo, :address, :logo)";
    $args = [':account_id'=>$this->account_id, ':ssmNo'=>$this->ssmNo, ':address'=>$this->address, ':logo'=>$this->logo];

    $stmt = SP_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function checkSP_Acc(){ //Retrieve service provider authentication from database
    $sql = "select * from Account where account_type = 'Service Provider' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];
    
    $stmt = SP_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getSP_Info(){ //retrieve service provider account info from database
    $sql = "select account_id, status from Account where account_type = 'Service Provider' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];
    
    $stmt = SP_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }

}
?>