<?php
    class User{
     
        // database connection and table name
        private $conn;
        private $table_name = "users";
     
        // object properties
        public $id;
        public $firstname;
        public $lastname;
        public $password;
        public $email;
        public $position;
        public $address;
        public $sex;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        // signup user
        function signup(){
            if($this->isAlreadyExist()){
                return false;
            }
            // query to insert record
            $query = "INSERT INTO
                        " . $this->table_name . "
                    SET
                        id=:id, firstname=:firstname, lastname=:lastname, password=:password, email=:email, position=:position, address=:address, sex=:sex";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->firstname=htmlspecialchars(strip_tags($this->firstname));
            $this->lastname=htmlspecialchars(strip_tags($this->lastname));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->position=htmlspecialchars(strip_tags($this->position));
            $this->address=htmlspecialchars(strip_tags($this->address));
            $this->sex=htmlspecialchars(strip_tags($this->sex));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":firstname", $this->firstname);
            $stmt->bindParam(":lastname", $this->lastname);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":position", $this->position);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":sex", $this->sex);
            // execute query
            if($stmt->execute()){
                $this->id = $this->conn->lastInsertId();
                return true;
            }
            return false;
        }
        // login user
        function login(){
            // select all query
            $query = "SELECT
                `id`, `firstname`, `lastname`, `password`, `email`, `position`, `address`, `sex`
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."' AND password='".$this->password."'";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            return $stmt;
        }
        
        // a function to check if email already exists
        function isAlreadyExist(){
            $query = "SELECT *
                FROM
                    " . $this->table_name . " 
                WHERE
                    email='".$this->email."'";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            if($stmt->rowCount() > 0){
                return true;
            }
            else{
                return false;
            }
        }
    }