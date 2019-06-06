<?php
     
     // get database connection
     include_once '../config/database.php';
      
     // instantiate user object
     include_once '../objects/user.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $user = new User($db);
      
     // set user property values
     $user->id = $_POST['id'];
     $user->firstname = $_POST['firstname'];
     $user->lastname = $_POST['lastname'];
     $user->password = $_POST['password'];
     $user->email = $_POST['email'];
     $user->position = $_POST['position'];
     $user->address = $_POST['address'];
     $user->sex = $_POST['sex'];
      
     // create the user
     if($user->signup()){
         $user_arr=array(
             "status" => true,
             "message" => "Successfully Signup!",
             "id" => $user->id,
            "firstname" => $user->firstname,
            "lastnamed" => $user->lastname,
            "password" => $user->password,
            "email" => $user->email,
            "position" => $user->position,
            "address" => $user->address,
            "sex" => $user->sex
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