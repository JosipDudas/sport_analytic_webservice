<?php
    class ReservationItem{
     
        // database connection and table name
        private $conn;
        private $table_name = "reservation_items";
     
        // object properties
        public $id;
        public $product_id;
        public $reservation_id;
        public $from;
        public $to;
        public $quantity;
     
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

        public function set_from($from) {
            $this->from = $from;
        }

        public function set_to($to) {
            $this->to = $to;
        }

        public function set_quantity($quantity) {
            $this->quantity = $quantity;
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

        public function get_from() {
            return $this->from;
        }

        public function get_to() {
            return $this->to;
        }

        public function get_quantity() {
            return $this->quantity;
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
                        id=:id, product_id=:product_id, reservation_id=:reservation_id, from=:from, to=:to, quantity=:quantity";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->reservation_id=htmlspecialchars(strip_tags($this->reservation_id));
            $this->from=htmlspecialchars(strip_tags($this->from));
            $this->to=htmlspecialchars(strip_tags($this->to));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":reservation_id", $this->reservation_id);
            $stmt->bindParam(":from", $this->from);
            $stmt->bindParam(":to", $this->to);
            $stmt->bindParam(":quantity", $this->quantity);
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
                        id=:id, product_id=:product_id, reservation_id=:reservation_id, from=:from, to=:to, quantity=:quantity WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->reservation_id=htmlspecialchars(strip_tags($this->reservation_id));
            $this->from=htmlspecialchars(strip_tags($this->from));
            $this->to=htmlspecialchars(strip_tags($this->to));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":reservation_id", $this->reservation_id);
            $stmt->bindParam(":from", $this->from);
            $stmt->bindParam(":to", $this->to);
            $stmt->bindParam(":quantity", $this->quantity);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
    }
?>