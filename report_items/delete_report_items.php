<?php
     // get database connection
     include_once '../config/database.php';
      
     include_once '../objects/report_item.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reportItem = new ReportItem($db);
      
     $reportItem->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($reportItem->deleteReportItems()){
         $reportItem_arr=array(
            "status" => true,
            "message" => "Successfully delete report item!",
            "id" => $reportItem->get_id(),
            "report_id" => $reportItem->get_report_id(),
            "product_id" => $reportItem->get_product_id(),
            "quantity" => $reportItem->get_quantity()
         );
     }
     else{
         $reportItem_arr=array(
             "status" => false,
             "message" => "Delete report item failed!"
         );
     }
     print_r(json_encode($reportItem_arr));
?>