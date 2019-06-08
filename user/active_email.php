<?php
    // get database connection
    include_once '../config/database.php';
        
    // instantiate user object
    include_once '../objects/user.php';

    $database = new Database();
    $db = $database->getConnection();
    
    $user = new User($db);
    
	if(!empty($_GET["id"])) {
        $user->set_id(isset($_GET['id']) ? $_GET['id'] : '');
        if($user->activeUser()){
            Echo "<!DOCTYPE html>
                <html>
                <body>
                <h1 align=\"center\">Sport Analytic</h1>
                <h2 align=\"center\">User account is  susccessfully activated!</h2>
                <p align=\"center\">You can now login to SportAnalytic Android application.</p>
                </body>
                </html>";
        }
        else{
            Echo "<!DOCTYPE html>
                <html>
                <body>
                <h1 align=\"center\">Sport Analytic</h1>
                <h2 align=\"center\">Problem with activation!</h2>
                <p align=\"center\">Try again.</p>
                </body>
                </html>";
        }
	}
?>