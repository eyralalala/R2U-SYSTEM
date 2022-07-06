<?php
require_once '../../../Business Services Layer/model/A_Model/UserModel.php';

class UserController{
    
  function viewAllApplication($type, $offset, $rowlimit){
    $admin = new UserModel();
    return $admin->getAllApplication($type, $offset, $rowlimit);
    
  }//end function

  function getTotalUser(){
    $admin = new UserModel();
    return $admin->countTotalUser();
    
  }//end function

  function getRows($type, $people){
    $admin = new UserModel();
    return $admin->countRow($type, $people);
  }

  function getSearchRows($type, $result){
    $admin = new UserModel();
    return $admin->countSearchedRow($type, $result);
  }

  function viewApplication($id, $type){

    $admin = new UserModel();
    return $admin->getApplication($id, $type);

  }//end function

  function changeStatus($status){
  	$admin = new UserModel();
  	$admin->account_id = $_POST['account_id'];

  	if($admin->setStatus($status)){
  		if($status=="Rejected")
        	$message = "Application Rejected!";
        else $message = "Application Approved!";
		echo "<script type='text/javascript'>alert('$message');
		window.location = 'A_Home.php?page=".$_POST['y']."Application&currentpage=".$_POST['currentpage']."';</script>";
  	}
	}

  function viewAllUser($type, $result, $offset, $rowlimit){
    $admin = new UserModel();
    return $admin->getAllUser($type, $result, $offset, $rowlimit);
  }

  function countItem($id){
    $admin = new UserModel();
    return $admin->getItemCount($id);
  }
}
?>
