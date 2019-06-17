<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/product.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $product = new Product($db);

    $product->set_categorie_id(isset($_GET['categorie_id']) ? $_GET['categorie_id'] : die());

    $stmt = $product->getAllProductForSpecificCategorie();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $products = array();
        do {
            array_push($products, array(
                "id" => $row[0],
                "name" => $row[1],
                "categorie_id" => $row[2]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $product_arr=array(
            "status" => true,
            "message" => "Successfully fetch product!",
            "product" => $products
        );
    } else{
        $product_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($product_arr));
?>