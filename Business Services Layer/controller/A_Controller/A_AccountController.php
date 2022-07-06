<?php
require_once '../../../Business Services Layer/model/A_Model/A_AccountModel.php';

if($setting!="add"){
  session_start();
  session_destroy();
}

class A_AccountController{

  function A_AccountLogin(){

    $admin = new A_AccountModel();
    $admin->email = $_POST['adminEmail'];
    $admin->password = $_POST['adminPassword'];

    if ($admin->checkA_Acc() > 0) {

      $result = $admin->getA_ID();

      foreach ($result as $row)
        $account_id = $row['account_id'];

      session_start();
      $_SESSION['account_id'] = $account_id;

      $message = "Login Successful!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../../Application Layer/view/A_View/A_Home.php';</script>";

    }else{

        $message = "Incorrect email/password!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = '../../../Application Layer/view/A_View/A_Login.php';</script>";
    }
  }//end function

  function addAdmin(){
    $type = "Admin";
    $admin = new A_AccountModel();

    $admin->email = $_POST['adminEmail'];

    if($admin->checkEmail()>0){
      return true;
    } 

    $admin->account_type = $type;
    $ID = $admin->getLastA_ID($type);
    $ID++;

    $admin->account_id = $ID;
    $admin->name = "Sub Admin ".substr($ID, 5);
    $admin->contact_no = $_POST['adminPhone'];
    $admin->password = $_POST['accPassword'];
    $admin->status = "Active";  

    if($admin->A_addNewAccount() > 0){
      $message = "Registration Complete!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = 'A_Home.php?page=addAdmin';</script>";
    }
    
  }//end function
}
?>
