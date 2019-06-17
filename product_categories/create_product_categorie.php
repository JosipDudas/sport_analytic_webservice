<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/product_categorie.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $productCategorie = new ProductCategorie($db);
      
     $productCategorie->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $productCategorie->set_name(isset($_GET['name']) ? $_GET['name'] : '');
     $productCategorie->set_description(isset($_GET['description']) ? $_GET['description'] : '');
     $productCategorie->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : '');
      
     if($productCategorie->insertProductCategorie()){
         $productCategorie_arr=array(
            "status" => true,
            "message" => "Successfully insert product categorie!",
            "id" => $productCategorie->get_id(),
            "name" => $productCategorie->get_name(),
            "description" => $productCategorie->get_description(),
            "location_id" => $productCategorie->get_location_id()
         );
     }
     else{
         $productCategorie_arr=array(
             "status" => false,
             "message" => "Insert product categorie failed!"
         );
     }
     print_r(json_encode($productCategorie_arr));
?>