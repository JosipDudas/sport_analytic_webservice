<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/report_item.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $reportItem = new ReportItem($db);

    $reportItem->set_report_id(isset($_GET['report_id']) ? $_GET['report_id'] : die());

    $stmt = $reportItem->getAllReportItemsForSpecificReports();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $reportItems = array();
        do {
            array_push($reportItems, array(
                "id" => $row[0],
                "report_id" => $row[1],
                "product_id" => $row[2],
                "quantity" => $row[3]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $reportItem_arr=array(
            "status" => true,
            "message" => "Successfully fetch report item!",
            "reportItem" => $reportItems
        );
    } else{
        $reportItem_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($reportItem_arr));
?>