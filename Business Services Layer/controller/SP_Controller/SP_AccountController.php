<?php
require_once '../../../Business Services Layer/model/SP_Model/SP_AccountModel.php';

session_start();
session_destroy();

class SP_AccountController{

  function SP_Registration(){

    $provider = new SP_AccountModel();

    $provider->email = $_POST['provEmail'];

    if($provider->checkEmail()>0){
      return true;
    } 

    $ID = $provider->getLastSP_ID();
    $ID++;

    $provider->account_id = $ID;
    $provider->name = $_POST['provName'];
    $provider->address = $_POST['address'];
    $provider->contact_no = $_POST['provContact'];
    $provider->password = $_POST['accPassword'];
    $provider->status = "Pending";
    $provider->ssmNo = $_POST['ssm'];

    $file = $_FILES['logo'];
    $fileName = $_FILES['logo']['name'];
    $fileTmpName = $_FILES['logo']['tmp_name'];
    $fileSize = $_FILES['logo']['size'];
    $fileError = $_FILES['logo']['error'];
    $fileType = $_FILES['logo']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        $fileNameNew = $ID.".".$fileActualExt;
        $fileDestination = '../../../Application Layer/view/Upload/SP_Logo/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "There was an error uploading your file!";
      } 
    }else {
      echo "You cannot upload files of this type!";
    }

    $provider->logo = $fileNameNew;

    if($provider->SP_addNewAccount() > 0){
      $message = "Registration Complete!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = 'SP_Login.php';</script>";
    }
    
  }

  function SP_AccountLogin(){

    $provider = new SP_AccountModel();
    $provider->email = $_POST['provEmail'];
    $provider->password = $_POST['provPassword'];

    if ($provider->checkSP_Acc() > 0) {

      $result = $provider->getSP_Info();

      foreach ($result as $row)
        $account_id = $row['account_id'];
        $status = $row['status'];

      session_start();
      $_SESSION['account_id'] = $account_id;
      $_SESSION['status'] = $status;

     	$message = "Login Successful!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../../Application Layer/view/SP_View/SP_Home.php';</script>";

    }else{

        $message = "Incorrect email/password!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = '../../../Application Layer/view/SP_View/SP_Login.php';</script>";
    }
  }//end function

}
?>
