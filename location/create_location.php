<?php
     
     // get database connection
     include_once '../config/database.php';
      
     // instantiate user object
     include_once '../objects/location.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $location = new Location($db);
      
     // set user property values
     $location->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $location->set_name(isset($_GET['name']) ? $_GET['name'] : '');
     $location->set_description(isset($_GET['description']) ? $_GET['description'] : '');
     $location->set_company_id(isset($_GET['company_id']) ? $_GET['company_id'] : '');
      
     // create the user
     if($location->insertLocation()){
         $location_arr=array(
            "status" => true,
            "message" => "Successfully insert location!",
            "id" => $user->get_id(),
            "name" => $user->get_name(),
            "description" => $user->get_description(),
            "company_id" => $user->get_company_id()
         );
     }
     else{
         $user_arr=array(
             "status" => false,
             "message" => "Insert location failed!"
         );
     }
     print_r(json_encode($user_arr));
?>