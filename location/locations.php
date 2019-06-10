<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/location.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $location = new Location($db);

    $location->set_company_id(isset($_GET['company_id']) ? $_GET['company_id'] : die());

    $stmt = $location->getAllLocationsForSpecificCompany();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $locations = array();
        do {
            array_push($locations, array(
                "id" => $row[0],
                "name" => $row[1],
                "description" => $row[2],
                "company_id" => $row[3]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $location_arr=array(
            "status" => true,
            "message" => "Successfully fetch locations!",
            "locations" => $locations
        );
    } else{
        $location_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($location_arr));
?>