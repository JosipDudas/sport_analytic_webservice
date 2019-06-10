<?php
    class Location{
     
        // database connection and table name
        private $conn;
        private $table_name = "locations";
     
        // object properties
        public $id;
        public $name;
        public $description;
        public $company_id;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function set_id($id) {
            $this->id = $id;
        }

        public function set_name($name) {
            $this->name = $name;
        }

        public function set_description($description) {
            $this->description = $description;
        }

        public function set_company_id($company_id) {
            $this->company_id = $company_id;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_description() {
            return $this->description;
        }

        public function get_company_id() {
            return $this->company_id;
        }

        function getAllLocationsForSpecificCompany(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE company_id='".$this->company_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertLocation() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, name=:name, description=:description, company_id=:company_id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->company_id=htmlspecialchars(strip_tags($this->company_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":company_id", $this->company_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>