<?php
     
     // get database connection
     include_once '../config/database.php';
      
     // instantiate user object
     include_once '../objects/user.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $user = new User($db);
      
     // set user property values
     $user->set_id(isset($_POST['id']) ? $_POST['id'] : die());
     $user->set_firstname(isset($_POST['firstname']) ? $_POST['firstname'] : die());
     $user->set_lastname(isset($_POST['lastname']) ? $_POST['lastname'] : die());
     $user->set_password(isset($_POST['password']) ? $_POST['password'] : die());
     $user->set_email(isset($_POST['email']) ? $_POST['email'] : die());
     $user->set_position(isset($_POST['position']) ? $_POST['position'] : die());
     $user->set_address(isset($_POST['address']) ? $_POST['address'] : die());
     $user->set_sex(isset($_POST['sex']) ? $_POST['sex'] : die());
      
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
            "sex" => $user->get_sex()
         );
     }
     else{
         $user_arr=array(
             "status" => false,
             "message" => "Email already exists!"
         );
     }
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
            "sex" => $user->get_sex()
         );
     print_r(json_encode($user_arr));
     ?>