<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/report_item.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reportItem = new ReportItem($db);
      
     $reportItem->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $reportItem->set_product_id(isset($_GET['product_id']) ? $_GET['product_id'] : '');
     $reportItem->set_report_id(isset($_GET['report_id']) ? $_GET['report_id'] : '');
     $reportItem->set_quantity(isset($_GET['quantity']) ? $_GET['quantity'] : '');
      
     if($reportItem->insertReportItems()){
         $reportItem_arr=array(
            "status" => true,
            "message" => "Successfully insert report item!",
            "id" => $reportItem->get_id(),
            "product_id" => $reportItem->get_product_id(),
            "report_id" => $reportItem->get_report_id(),
            "quantity" => $reportItem->get_quantity()
         );
     }
     else{
         $reportItem_arr=array(
             "status" => false,
             "message" => "Insert report item failed!"
         );
     }
     print_r(json_encode($reportItem_arr));
?>