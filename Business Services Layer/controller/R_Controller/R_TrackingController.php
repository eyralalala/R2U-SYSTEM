<?php
require_once '../../../Business Services Layer/model/R_Model/R_TrackingModel.php';

class R_TrackingController{

  function viewAllReport($id){ 
    $report = new R_TrackingModel();
    return $report->getAllReport($id);
  }
}
?>
