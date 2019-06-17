<?php
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/reservation_item.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reservationItem = new ReservationItem($db);
      
     $reservationItem->set_id(isset($_GET['id']) ? $_GET['id'] : '');
      
     if($reservationItem->deleteReservation()){
         $reservationItem_arr=array(
            "status" => true,
            "message" => "Successfully delete reservation item!",
            "id" => $reservationItem->get_id(),
            "product_id" => $reservationItem->get_product_id(),
            "reservation_id" => $reservationItem->get_reservation_id(),
            "from" => $reservationItem->get_from(),
            "to" => $reservationItem->get_to(),
            "quantity" => $reservationItem->get_quantity()
         );
     }
     else{
         $reservationItem_arr=array(
             "status" => false,
             "message" => "Delete reservation item failed!"
         );
     }
     print_r(json_encode($reservationItem_arr));
?>