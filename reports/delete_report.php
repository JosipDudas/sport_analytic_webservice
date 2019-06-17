<?php
     // get database connection
     include_once '../config/database.php';
      
     include_once '../objects/report.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $report = new Report($db);
      
     $report->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($report->deleteReport()){
         $report_arr=array(
            "status" => true,
            "message" => "Successfully delete report!",
            "id" => $report->get_id(),
            "date" => $report->get_date(),
            "location_id" => $report->get_location_id()
         );
     }
     else{
         $report_arr=array(
             "status" => false,
             "message" => "Delete report failed!"
         );
     }
     print_r(json_encode($report_arr));
?>