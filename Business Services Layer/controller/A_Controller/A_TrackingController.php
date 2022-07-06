<?php
require_once '../../../Business Services Layer/model/A_Model/A_TrackingModel.php';

class A_TrackingController{

  function viewAllReport(){ 
    $report = new A_TrackingModel();
    return $report->getAllReport();
  }

  function runnerName($id){ 
    $report = new A_TrackingModel();
    $pdo_result = $report->getRunnerName($id);
    foreach ($pdo_result as $row) {
    	return $row['name'];
    }
  }
}
?>
