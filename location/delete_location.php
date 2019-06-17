<?php
     // get database connection
     include_once '../config/database.php';
      
     include_once '../objects/location.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $location = new Location($db);
      
     $location->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($location->deleteLocation()){
         $location_arr=array(
            "status" => true,
            "message" => "Successfully delete location!",
            "id" => $location->get_id(),
            "name" => $location->get_name(),
            "description" => $location->get_description(),
            "company_id" => $location->get_company_id()
         );
     }
     else{
         $location_arr=array(
             "status" => false,
             "message" => "Delete location failed!"
         );
     }
     print_r(json_encode($location_arr));
?>