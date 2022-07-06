<?php

class R_AccountModel{

  public $account_id, $name, $contact_no, $email, $password, $status, $profile_pic, $license;

  function connect(){ //connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=R2U', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }

  function checkEmail(){ //get email which are same with the input email from the database
    $sql = "select * from Account where email = :email";
    $args = [':email'=>$this->email];

    $stmt = R_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getLastR_ID(){ //get the most recent Runner ID from the database
    $sql = "select account_id from Account where account_type = 'Runner' order by account_id desc limit 1";
    
    $stmt = R_AccountModel::connect()->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();

    if ($count > 0) {

      foreach ($stmt as $row)
        return $row['account_id'];

    } else return "AA000000";
  }

  function R_addNewAccount(){ //Adding runner registered info into database
    $sql = "insert into Account values (:account_id, 'Runner', :name, :contact_no, :email, :password, :status)";
    $args = [':account_id'=>$this->account_id, ':name'=>$this->name, ':contact_no'=>$this->contact_no, ':email'=>$this->email, ':password'=>$this->password, ':status'=>$this->status];

    $stmt = R_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);

    $sql = "insert into Runner values (:account_id, :ic, :profile_pic, :license)";
    $args = [':account_id'=>$this->account_id, ':ic'=>$this->ic, ':profile_pic'=>$this->profile_pic, ':license'=>$this->license];

    $stmt = R_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function checkR_Acc(){ //Retrieve runner authentication from database
    $sql = "select * from Account where account_type = 'Runner' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];

    $stmt = R_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt->rowCount();
  }

  function getR_ID(){ //retrieve runner account info from database
    $sql = "select account_id, status from Account where account_type = 'Runner' and email = :email and password = :password";
    $args = [':email'=>$this->email, ':password'=>$this->password];
    
    $stmt = R_AccountModel::connect()->prepare($sql);
    $stmt->execute($args);
    return $stmt;
  }
}
?>