<?php
    class Reservation{
     
        // database connection and table name
        private $conn;
        private $table_name = "reservations";
     
        // object properties
        public $id;
        public $from;
        public $to;
        public $location_id;
        public $description;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function set_id($id) {
            $this->id = $id;
        }

        public function set_from($from) {
            $this->from = $from;
        }

        public function set_to($to) {
            $this->to = $to;
        }

        public function set_location_id($location_id) {
            $this->location_id = $location_id;
        }

        public function set_description($description) {
            $this->description = $description;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_from() {
            return $this->from;
        }

        public function get_to() {
            return $this->to;
        }

        public function get_location_id() {
            return $this->location_id;
        }

        public function get_description() {
            return $this->description;
        }

        function getAllReservationForSpecificLocation(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE location_id='".$this->location_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertReservation() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                         reservations.id=:id,  reservations.location_id=:location_id,  reservations.from=:from,  reservations.to=:to,  reservations.description=:description";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->from=htmlspecialchars(strip_tags($this->from));
            $this->to=htmlspecialchars(strip_tags($this->to));
            $this->location_id=htmlspecialchars(strip_tags($this->location_id));
            $this->description=htmlspecialchars(strip_tags($this->description));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":from", $this->from);
            $stmt->bindParam(":to", $this->to);
            $stmt->bindParam(":location_id", $this->location_id);
            $stmt->bindParam(":description", $this->description);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteReservation() {
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

        function updateReservation() {
            $query = "UPDATE ".$this->table_name." 
                        SET
                         reservations.id=:id,  reservations.location_id=:location_id,  reservations.description=:description,  reservations.from=:from,  reservations.to=:to WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->from=htmlspecialchars(strip_tags($this->from));
            $this->to=htmlspecialchars(strip_tags($this->to));
            $this->location_id=htmlspecialchars(strip_tags($this->location_id));
            $this->description=htmlspecialchars(strip_tags($this->description));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":from", $this->from);
            $stmt->bindParam(":to", $this->to);
            $stmt->bindParam(":location_id", $this->location_id);
            $stmt->bindParam(":description", $this->description);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>