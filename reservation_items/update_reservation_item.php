<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/reservation_item.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reservationItem = new ReservationItem($db);
      
     $reservationItem->set_id(isset($_GET['id']) ? $_GET['id'] : '');
     $reservationItem->set_product_id(isset($_GET['product_id']) ? $_GET['product_id'] : '');
     $reservationItem->set_reservation_id(isset($_GET['reservation_id']) ? $_GET['reservation_id'] : '');
      
     if($reservationItem->updateReservationItem()){
         $reservationItem_arr=array(
            "status" => true,
            "message" => "Successfully update reservation item!",
            "id" => $reservationItem->get_id(),
            "product_id" => $reservationItem->get_product_id(),
            "reservation_id" => $reservationItem->reservation_id()
         );
     }
     else{
         $reservationItem_arr=array(
             "status" => false,
             "message" => "Update reservation item failed!"
         );
     }
     print_r(json_encode($reservationItem_arr));
?>