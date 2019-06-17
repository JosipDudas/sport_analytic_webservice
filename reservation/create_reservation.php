<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/reservation.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reservation = new Reservation($db);
      
     $reservation->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $reservation->set_date(isset($_GET['date']) ? $_GET['date'] : '');
     $reservation->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : '');
      
     if($reservation->insertReservation()){
         $reservation_arr=array(
            "status" => true,
            "message" => "Successfully insert reservation!",
            "id" => $reservation->get_id(),
            "date" => $reservation->get_date(),
            "location_id" => $reservation->get_location_id()
         );
     }
     else{
         $reservation_arr=array(
             "status" => false,
             "message" => "Insert reservation failed!"
         );
     }
     print_r(json_encode($reservation_arr));
?>