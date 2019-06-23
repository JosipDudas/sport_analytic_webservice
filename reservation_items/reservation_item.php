<?php
     
     // get database connection
     include_once '../config/database.php';
    
     include_once '../objects/reservation_item.php';
      
     $database = new Database();
     $db = $database->getConnection();
      
     $reservationItem = new ReservationItem($db);

    $reservationItem->set_reservation_id(isset($_GET['reservation_id']) ? $_GET['reservation_id'] : die());

    $stmt = $reservationItem->getAllReservationItemsForSpecificReservation();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $reservationItems = array();
        do {
            array_push($reservationItems, array(
                "id" => $row[0],
                "date" => $row[1],
                "location_id" => $row[2]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $reservationItem_arr=array(
            "status" => true,
            "message" => "Successfully fetch reservation item!",
            "reservationItem" => $reservationItems
        );
    } else{
        $reservationItem_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($reservationItem_arr));
?>