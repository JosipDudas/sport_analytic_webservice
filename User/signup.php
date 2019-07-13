<?php
     
     // get database connection
     include_once '../config/database.php';
      
     // instantiate user object
     include_once '../objects/user.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $user = new User($db);
      
     // set user property values
     $user->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $user->set_firstname(isset($_GET['firstname']) ? $_GET['firstname'] : '');
     $user->set_lastname(isset($_GET['lastname']) ? $_GET['lastname'] : '');
     $user->set_password(isset($_GET['password']) ? $_GET['password'] : '');
     $user->set_email(isset($_GET['email']) ? $_GET['email'] : '');
     $user->set_position(isset($_GET['position']) ? $_GET['position'] : '');
     $user->set_address(isset($_GET['address']) ? $_GET['address'] : '');
     $user->set_gender(isset($_GET['gender']) ? $_GET['gender'] : '');
     $user->set_company_id(isset($_GET['company_id']) ? $_GET['company_id'] : '');
      
     // create the user
     if($user->signup()){
         $user_arr=array(
            "status" => true,
            "message" => "Successfully Signup!",
            "id" => $user->get_id(),
            "firstname" => $user->get_firstname(),
            "lastnamed" => $user->get_lastname(),
            "password" => $user->get_password(),
            "email" => $user->get_email(),
            "position" => $user->get_position(),
            "address" => $user->get_address(),
            "gender" => $user->get_gender()
         );
     }
     else{
         $user_arr=array(
             "status" => false,
             "message" => "Email already exists!"
         );
     }
     print_r(json_encode($user_arr));
?>