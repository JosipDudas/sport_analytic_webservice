<?php
    class Company{
     
        // database connection and table name
        private $conn;
        private $table_name = "companies";
     
        // object properties
        public $id;
        public $name;
        public $email;
        public $address;
     
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

        public function set_email($email) {
            $this->email = $email;
        }

        public function set_address($address) {
            $this->address = $address;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_name() {
            return $this->name;
        }

        public function get_lastname() {
            return $this->lastname;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_address() {
            return $this->address;
        }

        function getAllCompanies(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . "";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }
    }
?>