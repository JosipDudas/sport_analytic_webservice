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
        public $active;
        public $company_id;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function set_id($id) {
            $this->id = $id;
        }

        public function set_firstname($firstname) {
            $this->firstname = $firstname;
        }

        public function set_lastname($lastname) {
            $this->lastname = $lastname;
        }

        public function set_password($password) {
            $this->password = $password;
        }

        public function set_email($email) {
            $this->email = $email;
        }

        public function set_position($position) {
            $this->position = $position;
        }

        public function set_address($address) {
            $this->address = $address;
        }

        public function set_sex($sex) {
            $this->sex = $sex;
        }

        public function set_active($active) {
            $this->active = $active;
        }

        public function set_company_id($company_id) {
            $this->company_id = $company_id;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_firstname() {
            return $this->firstname;
        }

        public function get_lastname() {
            return $this->lastname;
        }

        public function get_password() {
            return $this->password;
        }

        public function get_email() {
            return $this->email;
        }

        public function get_position() {
            return $this->position;
        }

        public function get_address() {
            return $this->address;
        }

        public function get_sex() {
            return $this->sex;
        }

        public function get_active() {
            return $this->active;
        }

        public function get_company_id() {
            return $this->company_id;
        }

        // signup user
        function signup(){
            if($this->isAlreadyExist()){
                return false;
            }
            // query to insert record
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, firstname=:firstname, lastname=:lastname, password=:password, email=:email, position=:position, address=:address, sex=:sex, active=0, company_id=:company_id";
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
            $this->company_id=htmlspecialchars(strip_tags($this->company_id));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":firstname", $this->firstname);
            $stmt->bindParam(":lastname", $this->lastname);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":position", $this->position);
            $stmt->bindParam(":address", $this->address);
            $stmt->bindParam(":sex", $this->sex);
            $stmt->bindParam(":company_id", $this->company_id);
            // execute query
            if($stmt->execute()){
                if($this->sendEmail()) {
                    return true;
                }
                return false;
            }
            return false;
        }
        // login user
        function login(){
            // select all query
            $query = "SELECT
                `id`, `firstname`, `lastname`, `password`, `email`, `position`, `address`, `sex`, `company_id`
            FROM
                " . $this->table_name . " 
            WHERE
                email='".$this->email."' AND password='".$this->password."' AND active='1'";
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            // execute query
            $stmt->execute();
            return $stmt;
        }

        function activeUser() {
            if($this->isAlreadyExist()){
                return false;
            }

            $query = "UPDATE " . $this->table_name . " SET active = '1' WHERE id='".$this->id."'";

            // prepare query statement
            $stmt = $this->conn->prepare($query);

            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
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

        function sendEmail() {
            $actual_link = "https://sport-analytic.000webhostapp.com/api/user/active_email.php?id=" . $this->id;
            $subject = "User Registration Activation Email";
            $content = "<html>
                        <head>
                        <title>User activation</title>
                        </head>
                        <body>
                        <h1 align=\"center\">Sport Analytic</h1>
                        <h2 align=\"center\">User ".$this->firstname." ".$this->lastname." account activation</h2>
                        <p align=\"center\">Click this link to activate ".$this->firstname." ".$this->lastname." account. 
                        <a href='" . $actual_link . "'>" . $actual_link . "</a></p>
                        </body>
                        </html>";
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: josdudas@gmail.com\r\n";

            $query = "SELECT *
            FROM
                ".$this->table_name." 
            WHERE
                company_id='".$this->company_id."' AND position='admin'";

            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_LAST);
            do {
                mail($row[4], $subject, $content, $headers);
            } while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_PRIOR));
            
            return true;
        }
    }
?>