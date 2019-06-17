<?php
    class ReportItem{
     
        // database connection and table name
        private $conn;
        private $table_name = "report_items";
     
        // object properties
        public $id;
        public $report_id;
        public $product_id;
        public $quantity;
     
        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        public function set_id($id) {
            $this->id = $id;
        }

        public function set_report_id($report_id) {
            $this->report_id = $report_id;
        }

        public function set_product_id($product_id) {
            $this->product_id = $product_id;
        }

        public function set_quantity($quantity) {
            $this->quantity = $quantity;
        }

        // get
        public function get_id() {
            return $this->id;
        }

        public function get_report_id() {
            return $this->report_id;
        }

        public function get_product_id() {
            return $this->product_id;
        }

        public function get_quantity() {
            return $this->quantity;
        }

        function getAllReportItemsForSpecificReports(){
            // select all query
            $query = "SELECT
                *
            FROM
                " . $this->table_name . " WHERE report_id='".$this->report_id."'";
            $stmt = $this->conn->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));
            $stmt->execute();
            return $stmt;
        }

        function insertReportItems() {
            $query = "INSERT INTO
                        ".$this->table_name." 
                        SET
                        id=:id, report_id=:report_id, product_id=:product_id, quantity=:quantity";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->report_id=htmlspecialchars(strip_tags($this->report_id));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":report_id", $this->report_id);
            $stmt->bindParam(":product_id", $this->product_id);
            $stmt->bindParam(":quantity", $this->quantity);
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        function deleteReportItems() {
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

        function updateReportItems() {
            $query = "Update ".$this->table_name." 
                        SET
                        id=:id, report_id=:report_id, product_id=:product_id, quantity=:quantity WHERE id=:id";
            // prepare query
            $stmt = $this->conn->prepare($query);
            // sanitize
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->report_id=htmlspecialchars(strip_tags($this->report_id));
            $this->product_id=htmlspecialchars(strip_tags($this->product_id));
            $this->quantity=htmlspecialchars(strip_tags($this->quantity));
            // bind values
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":report_id", $this->report_id);
            $stmt->bindParam(":product_id", $this->product_id);
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