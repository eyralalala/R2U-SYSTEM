<?php
require_once '../../../Business Services Layer/model/C_Model/C_ItemModel.php';

class C_ItemController{

  function viewAllType($type){
    $customer = new C_ItemModel();
    return $customer->getTypeList($type);
  }//end function
  
    function viewAll(){
    $customer = new C_ItemModel();
    return $customer->getAllList();
  }//end function

  function viewSP_name($sp){
    $customer = new C_ItemModel();
    return $customer->getSP_name($sp);
  }//end function
  
  function viewAllItem($type, $sp){
    $customer = new C_ItemModel();
    return $customer->getAllItem($type, $sp);
  }//end function

  function viewSpecific($itemID){
    $customer = new C_ItemModel();
    $customer->item_id = $itemID;
    return $customer->viewSpecificItem();
  }//end function
 
}
?>
