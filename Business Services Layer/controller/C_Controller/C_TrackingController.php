<?php
require_once '../../../Business Services Layer/model/C_Model/C_TrackingModel.php';

class C_TrackingController{

  function viewAllReport($id){ 
    $report = new C_TrackingModel();
    return $report->getAllReport($id);
  }

  function trackDelivery($id){
  	$report = new C_TrackingModel();
    return $report->getDeliveryStatus($id);
  }
}
?>
