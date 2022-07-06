<?php
require_once '../../../Business Services Layer/model/SP_Model/SP_MenuModel.php';

class SP_MenuController{
    
  function addItem(){

    $provider = new SP_MenuModel();

    $provider->sp_account_id = $_POST['spAccountID'];

    $ID = $provider->getLastItemID();
    $ID++;

    $provider->item_id = $ID;
    $provider->item_type = $_POST['itemType'];
    $provider->item_name = $_POST['itemName'];
    $provider->item_detail = $_POST['itemDetail'];
    $provider->item_price = $_POST['itemPrice'];
    $provider->item_status = $_POST['itemStatus'];

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            $fileNameNew = $provider->item_id.".".$fileActualExt;
            $fileDestination = '../../../Application Layer/view/Upload/SP_Item/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
        } else {
            echo "There was an error uploading your file!";
        } }else {
            echo "You cannot upload files of this type!";
      }

    if($provider->addNewItem() > 0){
      $message = "Registration Complete!";
      /*echo "<script type='text/javascript'>alert('$message');
      window.location = '../../view/SP_View/SP_Home.php';</script>";*/
    }
    
  }//end function

  function viewAll(){
    $provider = new SP_MenuModel();
    $provider->sp_account_id = $_SESSION['account_id'];
    return $provider->viewAllItem();
  }//end function

  function viewOrder(){
    $provider = new SP_MenuModel();
    $provider->sp_account_id = $_SESSION['account_id'];
    return $provider->viewAllOrder();
  }

  function viewSpecific($itemID){
    $provider = new SP_MenuModel();
    $provider->item_id = $itemID;
    return $provider->viewSpecificItem();
  }//end function

  function modifyItem(){
    $provider = new SP_MenuModel();
    $provider->item_id = $_POST['itemID'];
    $provider->item_type = $_POST['itemType'];
    $provider->item_name = $_POST['itemName'];
    $provider->item_detail = $_POST['itemDetail'];
    $provider->item_price = $_POST['itemPrice'];
    $provider->item_status = $_POST['itemStatus'];

    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            $fileNameNew = $provider->item_id.".".$fileActualExt;
            $fileDestination = '../../../Application Layer/view/Upload/SP_Item/'.$fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);
        } else {
            echo "There was an error uploading your file!";
        } }else {
            echo "You cannot upload files of this type!";
      }
      
    if($provider->modifyItemInfo()){
      $message = "Update Successful!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../view/SP_View/View.php?itemID=".$_POST['itemID']."';</script>";
    }
  }//end function
  
  function delete(){
    $provider = new SP_MenuModel();
    $provider->item_id = $_POST['itemID'];

    if($provider->deleteItem()){
      $message = "Item Deleted!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../view/SP_View/SP_Home.php';</script>";
    }
  }//end function

  function deliver(){
    $provider = new SP_MenuModel();
    $ID = $provider->getLastDeliveryID();
    $ID++;
    $provider->delivery_id = $_SESSION['account_id'].$ID;
    $provider->order_id =  $_POST['order_id'];
    $provider->payment_id =  $_POST['payment_id'];
    $provider->r_account_id =  "0";
    $provider->delivery_status =  "preparing";
    if($provider->generateDelivery()){
      $message = "Delivery Generated!";
      echo "<script type='text/javascript'>alert('$message');
      window.location = '../../view/SP_View/SP_Home.php';</script>";
    }
  }

  
}
?>