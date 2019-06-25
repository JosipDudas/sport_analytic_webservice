<?php
     // get database connection
     include_once '../config/database.php';
      
     include_once '../objects/reservation.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reservation = new Reservation($db);
      
     $reservation->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($reservation->deleteReservation()){
         $reservation_arr=array(
            "status" => true,
            "message" => "Successfully delete reservation!",
            "id" => $reservation->get_id(),
            "from" => $reservation->get_from(),
            "to" => $reservation->get_to(),
            "location_id" => $reservation->get_location_id(),
            "description" => $reservation->get_description()
         );
     }
     else{
         $reservation_arr=array(
             "status" => false,
             "message" => "Delete reservation failed!"
         );
     }
     print_r(json_encode($reservation_arr));
?>