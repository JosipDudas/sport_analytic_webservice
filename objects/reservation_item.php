<?php
    class ReservationItem{
     
        // database connection and table name
        private $conn;
        private $table_name = "reservation_items";
     
        // object properties
        public $id;
        public $product_id;
        public $reservation_id;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function set_id($id) {
            $this->id = $id;
        }

        public function set_product_id($product_id) {
            $this->product_id = $product_id;
        }

        public function set_reservation_id($reservation_id) {
            $this->reservation_id = $reservation_id;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_product_id() {
            return $this->product_id;
        }

        public function get_reservation_id() {
            return $this->reservation_id;
        } 

        function getAllReservationItemsForSpecificReservation(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE reservation_id='".$this->reservation_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertReservationItem() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, product_id=:product_id, reservation_id=:reservation_id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->reservation_id=htmlspecialchars(strip_tags($this->reservation_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":reservation_id", $this->reservation_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteReservationItem() {
            $query = "DELETE FROM
                        ".$this->table_name." 
                        WHERE 
                        id=:id";

            $stmt = $this->conn->prepare($query);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function updateReservationItem() {
            $query = "UPDATE ".$this->table_name." 
                        SET
                        id=:id, product_id=:product_id, reservation_id=:reservation_id WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->reservation_id=htmlspecialchars(strip_tags($this->reservation_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":reservation_id", $this->reservation_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>