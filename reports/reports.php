<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/report.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $report = new Report($db);

    $report->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : die());

    $stmt = $report->getAllReportsForSpecificLocation();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $reports = array();
        do {
            array_push($reports, array(
                "id" => $row[0],
                "date" => $row[1],
                "location_id" => $row[2]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $report_arr=array(
            "status" => true,
            "message" => "Successfully fetch report!",
            "report" => $reports
        );
    } else{
        $report_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($report_arr));
?>