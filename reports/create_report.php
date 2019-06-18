<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/report.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $report = new Report($db);
      
     $report->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $report->set_date(isset($_GET['date']) ? $_GET['date'] : '');
     $report->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : '');
      
     if($report->insertReport()){
         $report_arr=array(
            "status" => true,
            "message" => "Successfully insert report!",
            "id" => $report->get_id(),
            "date" => $report->get_date(),
            "location_id" => $report->get_location_id()
         );
     }
     else{
         $report_arr=array(
             "status" => false,
             "message" => "Insert report failed!"
         );
     }
     print_r(json_encode($report_arr));
?>