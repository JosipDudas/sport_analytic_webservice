<?php
     // get database connection
     include_once '../config/database.php';
      
     include_once '../objects/product.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $product = new Product($db);
      
     $product->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($product->deleteProduct()){
         $product_arr=array(
            "status" => true,
            "message" => "Successfully delete product!",
            "id" => $product->get_id(),
            "name" => $product->get_name(),
            "categorie_id" => $product->get_categorie_id()
         );
     }
     else{
         $product_arr=array(
             "status" => false,
             "message" => "Delete product failed!"
         );
     }
     print_r(json_encode($product_arr));
?>