<?php
require_once '../../../Business Services Layer/model/R_Model/R_AccountModel.php';

session_start();
session_destroy();

class R_AccountController{

  function R_Registration(){ //process runner registration

    $runner = new R_AccountModel();

    $runner->email = $_POST['runnerEmail'];

    if($runner->checkEmail()>0){
      return true;
    } 

    $ID = $runner->getLastR_ID();
    $ID++;

    $runner->account_id = $ID;
    $runner->name = $_POST['runnerName'];
    $runner->contact_no = $_POST['runnerPhone'];
    $runner->email = $_POST['runnerEmail'];
    $runner->password = $_POST['accPassword'];
    $runner->status = "Pending";
    $runner->ic = $_POST['runnerIC'];

    //upload profile photo
    $file = $_FILES['profile_pic'];
    $fileName = $_FILES['profile_pic']['name'];
    $fileTmpName = $_FILES['profile_pic']['tmp_name'];
    $fileSize = $_FILES['profile_pic']['size'];
    $fileError = $_FILES['profile_pic']['error'];
    $fileType = $_FILES['profile_pic']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        $fileNameNew = $ID.".".$fileActualExt;
        $fileDestination = '../../../Application Layer/view/Upload/R_Profile/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "There was an error uploading your file!";
      } 
    }else {
      echo "You cannot upload files of this type!";
    }
    $runner->profile_pic = $fileNameNew;
    //end profile photo upload

    //upload license photo
    $file = $_FILES['license'];
    $fileName = $_FILES['license']['name'];
    $fileTmpName = $_FILES['license']['tmp_name'];
    $fileSize = $_FILES['license']['size'];
    $fileError = $_FILES['license']['error'];
    $fileType = $_FILES['license']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
        $fileNameNew = "L_".$ID.".".$fileActualExt;
        $fileDestination = '../../../Application Layer/view/Upload/R_License/'.$fileNameNew;
        move_uploaded_file($fileTmpName, $fileDestination);
      } else {
        echo "There was an error uploading your file!";
      } 
    }else {
      echo "You cannot upload files of this type!";
    }
    $runner->license = $fileNameNew;
    //end license photo upload

    if($runner->R_addNewAccount() > 0){
      $message = "Registration Complete!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = 'R_Login.php';</script>";
    }
    
  }//end function

  function R_AccountLogin(){ //process runner login

    $runner = new R_AccountModel();
    $runner->email = $_POST['runnerEmail'];
    $runner->password = $_POST['runnerPassword'];

    if ($runner->checkR_Acc() > 0) {

      $result = $runner->getR_ID();

      foreach ($result as $row){
        $account_id = $row['account_id'];
        $status = $row['status'];
      }

      session_start();
      $_SESSION['account_id'] = $account_id;
      $_SESSION['status'] = $status;

     	$message = "Login Successful!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../../Application Layer/view/R_View/R_Home.php';</script>";

    }else{

        $message = "Incorrect email/password!";
        echo "<script type='text/javascript'>alert('$message');
        window.location = '../../../Application Layer/view/R_View/R_Login.php';</script>";
    }
  }//end function
}
?>
