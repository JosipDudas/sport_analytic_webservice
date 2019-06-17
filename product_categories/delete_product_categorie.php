<?php
     // get database connection
     include_once '../config/database.php';
      
     include_once '../objects/product_categorie.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $productCategorie = new ProductCategorie($db);
      
     $productCategorie->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($productCategorie->deleteProductCategorie()){
         $productCategorie_arr=array(
            "status" => true,
            "message" => "Successfully delete product categorie!",
            "id" => $productCategorie->get_id(),
            "name" => $productCategorie->get_name(),
            "description" => $productCategorie->get_description(),
            "location_id" => $productCategorie->get_location_id()
         );
     }
     else{
         $productCategorie_arr=array(
             "status" => false,
             "message" => "Delete product categorie failed!"
         );
     }
     print_r(json_encode($productCategorie_arr));
?>