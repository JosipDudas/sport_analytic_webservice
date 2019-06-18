<?php
    class Product{
     
        // database connection and table name
        private $conn;
        private $table_name = "products";
     
        // object properties
        public $id;
        public $name;
        public $categorie_id;
     
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

        public function set_categorie_id($categorie_id) {
            $this->categorie_id = $categorie_id;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_categorie_id() {
            return $this->categorie_id;
        }

        function getAllProductForSpecificCategorie(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE categorie_id='".$this->categorie_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertProduct() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, name=:name, categorie_id=:categorie_id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->categorie_id=htmlspecialchars(strip_tags($this->categorie_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":categorie_id", $this->categorie_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteProduct() {
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

        function updateProduct() {
            $query = "UPDATE ".$this->table_name." 
                        SET
                        id=:id, name=:name, categorie_id=:categorie_id WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->categorie_id=htmlspecialchars(strip_tags($this->categorie_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":categorie_id", $this->categorie_id);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>