<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/product_categorie.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $productCategorie = new ProductCategorie($db);

    $productCategorie->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : die());

    $stmt = $productCategorie->getAllProductCategoriesForSpecificLocation();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $productCategories = array();
        do {
            array_push($productCategories, array(
                "id" => $row[0],
                "name" => $row[1],
                "description" => $row[2],
                "location_id" => $row[3]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $productCategorie_arr=array(
            "status" => true,
            "message" => "Successfully fetch product categories!",
            "product_categories" => $productCategories
        );
    } else{
        $productCategorie_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($productCategorie_arr));
?>