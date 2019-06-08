<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/company.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $company = new Company($db);

    $stmt = $company->getAllCompanies();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $companies = array();
        do {
            array_push($companies, array(
                "id" => $row[0],
                "name" => $row[1],
                "email" => $row[2],
                "address" => $row[3]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $company_arr=array(
            "status" => true,
            "message" => "Successfully fetch companies!",
            "companies" => $companies
        );
    } else{
        $company_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($company_arr));
?>