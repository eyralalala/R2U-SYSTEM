<?php
require_once '../../../Business Services Layer/model/C_Model/C_AccountModel.php';

session_start();
session_destroy();

class C_AccountController{

  function C_Registration(){

    $customer = new C_AccountModel();

    $customer->email = $_POST['custEmail'];

    if($customer->checkEmail()>0){
      return true;
    } 

    $ID = $customer->getLastC_ID();
    $ID++;

    $customer->account_id = $ID;
    $customer->name = $_POST['custName'];
    $customer->contact_no = $_POST['custPhone'];
    $customer->password = $_POST['accPassword'];
    $customer->status = "Active";  

    if($customer->C_addNewAccount() > 0){
      $message = "Registration Complete!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = 'C_Login.php';</script>";
    }
    
  }//end function

  function C_AccountLogin(){

    $customer = new C_AccountModel();
    $customer->email = $_POST['custEmail'];
    $customer->password = $_POST['custPassword'];

    if ($customer->checkC_Acc() > 0) {

      $result = $customer->getC_ID();

      foreach ($result as $row){
        $account_id = $row['account_id'];
        $name = $row['name'];
      }

      session_start();
      $_SESSION['account_id'] = $account_id;
      $_SESSION['name'] = $name;

     	$message = "Login Successful!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../../Application Layer/view/C_View/C_Home.php';</script>";

    }else{

        $message = "Incorrect email/password!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = '../../../Application Layer/view/C_View/C_Login.php';</script>";
    }
  }//end function

}
?>
