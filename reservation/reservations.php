<?php
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/reservation.php';
     
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
     
    $reservation = new Reservation($db);

    $reservation->set_location_id(isset($_GET['location_id']) ? $_GET['location_id'] : die());

    $stmt = $reservation->getAllReservationForSpecificLocation();

    if($stmt->rowCount() > 0){
        $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
        $reservations = array();
        do {
            array_push($reservations, array(
                "id" => $row[0],
                "from" => $row[1],
                "to" => $row[2],
                "location_id" => $row[3],
                "description" => $row[4]
            ));
        } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));

        // create array
        $reservation_arr=array(
            "status" => true,
            "message" => "Successfully fetch reservation!",
            "reservation" => $reservations
        );
    } else{
        $reservation_arr=array(
            "status" => false,
            "message" => "Error!",
        );
    }
    // make it json format
    print_r(json_encode($reservation_arr));
?>