<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/user.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    // prepare user object
    $user = new User($db);
    
    $user->set_email(isset($_GET['email']) ? $_GET['email'] : die());
    $user->set_password(isset($_GET['password']) ? $_GET['password'] : die());
    // read the details of user to be edited
    $stmt = $user->login();
    if($stmt->rowCount() > 0){
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // create array
        $user_arr=array(
            "status" => true,
            "message" => "Successfully Login!",
            "id" => $row['id'],
            "firstname" => $row['firstname'],
            "lastnamed" => $row['lastname'],
            "password" => $row['password'],
            "email" => $row['email'],
            "position" => $row['position'],
            "address" => $row['address'],
            "sex" => $row['sex']
        );
    } else{
        $user_arr=array(
            "status" => false,
            "message" => "Invalid Email or Password!",
        );
    }
    // make it json format
    print_r(json_encode($user_arr));
    ?>