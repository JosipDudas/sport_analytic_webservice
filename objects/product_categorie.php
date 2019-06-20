<?php
    class ProductCategorie{
     
        // database connection and table name
        private $conn;
        private $table_name = "product_categories";
     
        // object properties
        public $id;
        public $name;
        public $description;
        public $location_id;
     
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

        public function set_location_id($location_id) {
            $this->location_id = $location_id;
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

        public function get_location_id() {
            return $this->location_id;
        }

        public function get_address() {
            return $this->address;
        }

        function getAllProductCategoriesForSpecificLocation(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE location_id='".$this->location_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertProductCategorie() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, name=:name, description=:description, location_id=:location_id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->location_id=htmlspecialchars(strip_tags($this->location_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":location_id", $this->location_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteProductCategorie() {
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

        function updateProductCategorie() {
            $query = "UPDATE ".$this->table_name." 
                        SET
                        id=:id, name=:name, description=:description, location_id=:location_id WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->description=htmlspecialchars(strip_tags($this->description));
            $this->location_id=htmlspecialchars(strip_tags($this->location_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":description", $this->description);
            $stmt->bindParam(":location_id", $this->location_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>