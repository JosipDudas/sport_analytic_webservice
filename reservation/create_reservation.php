<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/reservation.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reservation = new Reservation($db);
      
     $reservation->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $reservationItem->set_from(isset($_GET['from']) ? $_GET['from'] : '');
     $reservationItem->set_to(isset($_GET['to']) ? $_GET['to'] : '');
     $reservation->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : '');
     $reservation->set_description(isset($_GET['description']) ? $_GET['description'] : '');
      
     if($reservation->insertReservation()){
         $reservation_arr=array(
            "status" => true,
            "message" => "Successfully insert reservation!",
            "id" => $reservation->get_id(),
            "from" => $reservationItem->get_from(),
            "to" => $reservationItem->get_to(),
            "location_id" => $reservation->get_location_id(),
            "description" => $reservation->get_description()
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