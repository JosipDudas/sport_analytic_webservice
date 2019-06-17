<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/product.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $product = new Product($db);
      
     $product->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $product->set_name(isset($_GET['name']) ? $_GET['name'] : '');
     $product->set_categorie_id(isset($_GET['categorie_id']) ? $_GET['categorie_id'] : '');
      
     if($product->updateProduct()){
         $product_arr=array(
            "status" => true,
            "message" => "Successfully update product!",
            "id" => $product->get_id(),
            "name" => $product->get_name(),
            "categorie_id" => $product->get_categorie_id()
         );
     }
     else{
         $product_arr=array(
             "status" => false,
             "message" => "Update product failed!"
         );
     }
     print_r(json_encode($product_arr));
?>