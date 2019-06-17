<?php
    class Report{
     
        // database connection and table name
        private $conn;
        private $table_name = "reports";
     
        // object properties
        public $id;
        public $date;
        public $location_id;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function set_id($id) {
            $this->id = $id;
        }

        public function set_date($date) {
            $this->date = $date;
        }

        public function set_location_id($location_id) {
            $this->location_id = $location_id;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_date() {
            return $this->date;
        }

        public function get_location_id() {
            return $this->location_id;
        }

        function getAllReportsForSpecificLocation(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE location_id='".$this->location_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertReport() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, date=:date, location_id=:location_id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->location_id=htmlspecialchars(strip_tags($this->location_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":location_id", $this->location_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteReport() {
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

        function updateReport() {
            $query = "UPDATE ".$this->table_name." 
                        SET
                        id=:id, date=:date, location_id=:location_id WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->date=htmlspecialchars(strip_tags($this->date));
            $this->location_id=htmlspecialchars(strip_tags($this->location_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":date", $this->date);
            $stmt->bindParam(":location_id", $this->location_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
    }
?>